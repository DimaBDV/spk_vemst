<template>
    <div class="container-fluid px-0 custom-overflow">
        <div class="row justify-content-center">
            <div class="col">

                <div class="card" v-if="(offers === null || offers.length === 0)  && !loadError">
                    <div class="card-body">
                            <p class="h2 text-center text-muted">
                                <i class="fas fa-ghost"></i>
                            </p>
                            <p class="h5 text-center text-muted">
                                Здесь поселился призрак
                            </p>
                    </div>
                </div>

                <!-- TODO: вывод списка не выполненных "предложений" -->
                <div class="card my-1 mx-1" v-else v-for="item in offers">
                    <div class="card-body">
                        <p class=" h4 card-title my-0">{{ item.section }}</p>
                        <p class="card-text my-0">{{ item.theme }}</p>
                        <p class="card-text text-right text-muted my-0">Создан: {{ item.created_at}}</p>
                        <button class="btn btn-outline-primary btn-block" @click="openModal(item)">Подробнее</button>
                    </div>
                </div>


                <div class="card" v-if="loadError">
                    <div class="card-body">
                        <p class="h2 text-center text-muted">
                            <i class="fas fa-hat-wizard"></i>
                            <i class="fas fa-ghost" style="
                            display: block;
                            margin-top: -.3rem;
                            "></i>
                        </p>
                        <p class="h5 text-center text-muted">
                            Кажется что-то пошло не так.
                        </p>
                        <button class="btn btn-block btn-secondary" @click="reloadOffers">Попробуйте повторить загрузку данного блока</button>
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
            // console.log('Component "waiting" mounted.')

            /**
             * Приём события newOffer
             * Подробнее читай в Docs\front\offerEmit
             */
            this.$root.$on('newOffer', data => {
                this.addNewOfferToOffersList(data);
            });

            this.getOffer();
        },
        data(){
            return {
                offers: null,

                loadError: false,
                errorMessage: null,

            }
        },
        methods:{
            /**
             * Поджог события для запуска модального окна
             * для просмотра текущего "предложения"
             */
            openModal(item){
                this.$root.$emit('openWaitingModal',item);
            },
            /**
             * Добавляем данные о новой "публикации" в массив
             */
            addNewOfferToOffersList(param){
              this.offers.unshift(param);
            },
            /**
             * Получить данные с webapi о текущих не выполненных "публикациях"
             */
            getOffer(){
                axios.get('/webapi/offer/list')
                    .then(response => {
                       this.offers = response.data;
                    })
                    .catch(error => {
                        this.loadError = true;
                        this.errorMessage = error;
                    });
            },

            reloadOffers(){
                this.loadError = false;
                this.errorMessage = null;
                this.getOffer();
            }
        }

    }
</script>

<style>
    .custom-overflow{
        max-height: 77vh;
        overflow-x: hidden !important;
    }
</style>