<template>
    <div class="container-fluid">
        <!-- Выбор раздела -->
        <div class="container-fluid">
            <div class="row">
                <div v-bind:class="{'col-12': !section.toggled, 'col-10': section.toggled}">
                    <p class="h4 text-center mb-2">{{ formData.section }}</p>
                </div>
                <!-- Кнопка удаления -->
                <div class="col-2" v-if="section.toggled">
                    <button class="btn btn-outline-danger rounded-circle" @click="clearSection"><i class="fas fa-redo"></i></button>
                </div>
            </div>
        </div>
        <!-- Кнопки выбора раздела -->
        <div class="row justify-content-center" v-if="!section.toggled">

            <div class="col-12 col-sm-4 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.docs; section.toggled = true; section.docsToggled = true">{{ section.docs }}</button>
            </div>

            <div class="col-12 col-sm-4 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.news; section.toggled = true; section.newsToggled = true">{{ section.news }}</button>
            </div>

            <div class="col-12 col-sm-4 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.schedule; section.toggled = true; section.scheduleToggled = true">{{ section.schedule }}</button>
            </div>

        </div>
        <!-- ______________________________________________________________________ -->
        <div class="dropdown-divider"></div>

        <!-- Описание в окне уведомления -->
        <div v-if="section.toggled" class="alert alert-warning alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Описание раздела.</h4>
            <p v-if="section.newsToggled">{{ section.newsDescription }}</p>
            <p v-if="section.scheduleToggled">{{ section.scheduleDescription }}</p>
            <p v-if="section.docsToggled">{{ section.docsDescription }}</p>

            <hr>
            <p class="mb-0">Просим серьёзно отнестить к вышеуказанным требованиям.
                <br>
                Это облегчит работу каждой из сторон и улучшит продуктивность работы.
            </p>


            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Конец описания -->
        <div class="container-fluid">

        </div>
    </div>
</template>

<script>
    import Axios from 'Axios';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                //Раздел
                section: {
                    news : 'Новости',
                    newsToggled:false,
                    newsDescription: 'Данный раздел предназначен для предложения новостей.',

                    schedule: 'Расписание',
                    scheduleToggled: false,
                    scheduleDescription:'Данный раздел предназначен для изменений в расписании, по отделениям "Очное" и "Заочное".',

                    docs: 'Документы',
                    docsToggled: false,
                    docsDescription:'Данный раздел предназначен для документации, положений, РУМО и т.д. Заполняя данный раздел пожалуйста укажите ссылку страницы на которой требуется изменить/добавить документ.',

                    toggled: false,
                },


                /**
                 * То что будет отправлено POST
                 */
                formData:{
                    section: 'Выберите раздел',
                    theme: '',
                    mainText: '',
                    file: [],
                    description: '',
                    url: '',
                    complete: null,
                    deadline: null
                }
            }
        },
        methods:{
            /**
             * Очистка всех указателей и перевод в default
             */
            clearSection(){
                this.formData.section = 'Выберите раздел';
                this.section.toggled = false;

                this.section.newsToggled = false;
                this.section.scheduleToggled = false;
                this.section.docsToggled = false;
            }
        }
    }
</script>
