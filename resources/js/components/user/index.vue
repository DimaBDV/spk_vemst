<template>
    <div class="container-fluid">

        <Profile v-show="toggled0"></Profile>
        <Notify v-show="toggled2"></Notify>
        <h2 v-if="toggled1" class="text-center">Извините, данная функция ещё не готова.</h2>

        <!-- TODO: Придумать как оптимизировать код, ибо эта тема с bool полная хуйня -->
        <nav class="navbar fixed-bottom navbar-dark bg-primary">
            <div class="navbar-collapse">
                <div class="container-fluid">
                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                        <button class="btn btn-primary" @click="
                            toggled0 = true
                            toggled1 = false
                            toggled2 = false"
                            v-bind:class="{ activeSelector: toggled0}">
                            <i class="fas fa-user"></i>
                            <span class="d-none d-sm-inline">Профиль</span>
                        </button>
                        <button class="btn btn-primary" @click="
                            toggled0 = false
                            toggled1 = true
                            toggled2 = false"
                                v-bind:class="{ activeSelector: toggled1}">
                            <i class="fas fa-user-cog"></i>
                            <span class="d-none d-sm-inline">Настройки</span>
                        </button>
                        <button class="btn btn-primary" @click="
                            toggled0 = false
                            toggled1 = false
                            toggled2 = true
                            readNotify()"
                                v-bind:class="{ activeSelector: toggled2}">
                            <i class="fas fa-bell"></i>
                            <span class="d-none d-sm-inline">Уведомления</span>
                            <span class="badge badge-pill badge-light ml-1" v-if="notify_count > 0">{{notify_count}}</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    import Profile from './modules/profile.vue'
    import Notify from './modules/notify.vue'

    import axios from 'axios';
    export default {
        components: {
            Profile,
            Notify
        },
        mounted() {

            this.$root.$on('userNotify', data => {
               this.notifyCounter(data);
            });

            this.$root.$on('userNotifyReadAll', () => {
                this.notify_count = 0;
            });

            this.loadUserData();
            this.loadNotifyData();
        },
        data(){
            return{
                /**
                 * Отвечает за то, какой компонент в данный момент активен
                 * 0 - Профиль
                 * 1 - Настройки пользователя
                 * 2 - Уведомления
                 */
                toggled0: true,
                toggled1: false,
                toggled2: false,

                notify_count: 0,

                URL_AUTH_DATA: '/webapi/me',
                URL_NOTIFY_DATA: '/webapi/notify'
            }
        },
        methods:{
            /**
             * Загрузка данных пользователя, Auth::user()
             */
            async loadUserData(){
                await axios.get(this.URL_AUTH_DATA)
                    .then(response => {
                        //Передача данных пользователя в компонент Profile
                        this.$root.$emit('userMe', response.data)
                    })
                    .catch(error => {
                    //    TODO: сделать что-то с ошибкой загрузки данных
                    });
            },
            /**
             * Загрузка данных по уведомлениям
             */
            async loadNotifyData(){
                await axios.get(this.URL_NOTIFY_DATA)
                    .then(response => {
                        return this.$root.$emit('userNotify', response.data)
                    })
                    .catch(error => {
                        //    TODO: сделать что-то с ошибкой загрузки данных
                    });
            },

            /**
             * Счётчик не прочитанных уведомлений
             * @param data
             * @return {*}
             */
            notifyCounter(data){
                return this.notify_count = data.unreadNotifications.length;
            },

            readNotify(){
                if(this.notify_count > 0){
                    this.$root.$emit('userNotifyMarkAsRead');
                }
            }
        }
    }
</script>

<style scoped>
    .btn-primary{
        color:rgba(255, 255, 255, 0.5)
    }
    .btn-primary:hover{
        background-color: #293e59 !important;
        border-color: #293e59 !important;
    }
    .btn-primary.active{
        background-color: #293e59 !important;
        border-color: #293e59 !important;
        color: #fff;
    }
    .activeSelector{
        color: #fff;
    }
</style>