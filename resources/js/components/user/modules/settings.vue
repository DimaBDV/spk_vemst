<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Настройки пользователя</h5>
                        <hr/>

                        <div class="container">
                            <p class="h2 text-center text-muted">
                                <i class="fas fa-hard-hat" style="display: block; margin-bottom: -1rem;"></i>
                                <i class="fas fa-ghost"></i>
                                <i class="fas fa-wrench" style="display: block;
                                                            margin-left: 3.3rem;
                                                            margin-top: -2.5rem;
                                                            transform: rotate(30deg);"
                                ></i>
                                <i class="fas fa-screwdriver" style="display: block;
                                                            margin-left: -3.3rem;
                                                            margin-top: -2.1rem;
                                                            transform: rotate(-110deg);"
                                ></i>
                            </p>
                            <p class="h5 text-center text-muted">
                                Данная функция ещё не готова, приходите позже.
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
            // console.log('Component user settings mounted.');
            
        },
        data(){
            return{

            }
        },
        methods:{

        },

    }
</script>

<style scoped>

</style>