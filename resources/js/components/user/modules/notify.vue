<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Уведомления</h5>
                        <hr/>
                        <div class="container" v-if="allNotify !== null && allNotify.length !== 0">
                            <div class="row">
                                <div class="col custom-overflow">

                                    <div class="" v-for="notify in allNotify">
                                        <div class="alert " role="alert"
                                             v-bind:class="{
                                             'alert-success':notify.read_at == null,
                                             'alert-light':notify.read_at != null
                                            }">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                                    @click="deleteNotify(notify)">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <div v-if="notify.type === newOffer">
                                                <h4 class="alert-heading">Новое предложение</h4>
                                                <hr/>
                                                <p>Ваше предложение в раздел <strong>{{notify.data.section}}</strong> успешно доваблено</p>
                                                <p>Дата создания: {{ notify.created_at }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container" v-else>
                            <p class="h2 text-center text-muted">
                                <i class="fas fa-ghost"></i>
                            </p>
                            <p class="h5 text-center text-muted">
                                Здесь поселился призрак
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        mounted() {
            console.log('Component mounted.');

            this.$root.$on('userNotify', data => {
                this.allNotify = data.allNotifications;
                this.unreadNotify = data.unreadNotifications;
                console.log(this.notify)
            });

            this.$root.$on('userNotifyMarkAsRead', () => {
                this.markAsRead();
            })
            
        },
        data(){
            return{
                allNotify: null,
                unreadNotify: null,

                //TODO: До прода!!!, разобраться с типами уведомлений, добавить сюда все!!!
                newOffer: 'App\\Notifications\\NewOfferNotification',

                URL_NOTIFY_MARK_AS_READ:'/webapi/notify/read_all',
                URL_NOTIFY_DELETE: '/webapi/notify/delete/'
            }
        },
        methods:{
            async markAsRead(){
                await axios.post(this.URL_NOTIFY_MARK_AS_READ)
                    .then(response => {
                        this.$root.$emit('userNotifyReadAll');
                    })
                    .catch(error => {
                        //    TODO: сделать что-то с ошибкой загрузки данных
                    })
            },

            // FIXME:Тупая идея удалять нотифы таким образом, сделать норм кнопку удаления и слать uuid на удаление конкретной нотифы
            /**
             * Функция для запуска удаления нотификаций (всех непрочитанных)
             * @return {Promise<void>}
             */
            async deleteNotify(notify){
               await this.sendDeleteNotifyRequest(notify.id);
            },

            /**
             * Функция посылает запрос на сервер для запуска Job`а удаления нотификаций
             * @param uuid
             * @return {Promise<void>}
             */
            async sendDeleteNotifyRequest(uuid){
                await axios.delete(this.URL_NOTIFY_DELETE + uuid)
                    .then(response => {
                        for(let item of this.allNotify){
                            if(item.id === uuid)
                            {
                                this.unreadNotify.splice(item, 1);
                            }
                        }
                    })
                    .catch(error => {

                    })
            }
        },

    }
</script>

<style scoped>
    .custom-overflow{
        max-height: calc(100vh - 250px);
        min-height: 200px;
        overflow-x: hidden !important;
    }
</style>