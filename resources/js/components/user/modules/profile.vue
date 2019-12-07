<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Профиль</h5>
                        <hr/>
                        <div class="container" v-if="user != null">

                            <div class="row">
                                <div class="col-1">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="col">
                                    {{user.name}} {{user.fathers_name}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-1">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="col">
                                    {{user.unit}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-1">
                                    <i class="fas fa-at"></i>
                                </div>
                                <div class="col">
                                    {{user.email}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-1">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                <div class="col">
                                    <span v-if="user.group === 'A'">Администратор</span>
                                    <span v-if="user.group === 'M'">Модератор</span>
                                    <span v-if="user.group === 'U'">Пользователь</span>
                                    <span v-if="user.group === 'B'">Заблокирован</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');

            this.$root.$on('userMe', data => {
                this.user = data;
                console.log(this.user)
            })
        },
        data(){
            return{
                user: null,
            }
        },
        methods:{

        }
    }
</script>
