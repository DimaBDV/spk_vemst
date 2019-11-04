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
                    <button class="btn btn-outline-danger rounded-circle" @click="clearSection"><i class="fas fa-reply"></i></button>
                </div>
            </div>
        </div>
        <!-- Кнопки выбора раздела -->
        <div class="row justify-content-center" v-if="!section.toggled">

            <div class="col-12 col-sm-3 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.docs; section.toggled = true; section.docsToggled = true">{{ section.docs }}</button>
            </div>

            <div class="col-12 col-sm-3 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.news; section.toggled = true; section.newsToggled = true">{{ section.news }}</button>
            </div>

            <div class="col-12 col-sm-3 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.schedule; section.toggled = true; section.scheduleToggled = true">{{ section.schedule }}</button>
            </div>

            <div class="col-12 col-sm-3 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.any; section.toggled = true; section.anyToggled = true">{{ section.any }}</button>
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
            <p v-if="section.anyToggled">{{ section.anyDescription }}</p>

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

        <!-- Форма для заполнения и отправки -->
        <div class="" v-if="section.toggled">

            <!-- Инпуты для секции News -->
            <div class="" id="news" v-if="section.newsToggled">

                <div class="form-group row">
                    <label for="ThemeInput"> <i class="fas fa-bullhorn"></i> Тема</label>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="ThemeInput" aria-describedby="ThemeHelp" placeholder="Тема новости" v-model="formData.theme" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button" id="button-news_trash" @click="formData.theme = '' ">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <small id="ThemeHelp" class="form-text text-muted">Данное поле используется для указания темы новости. Для очистки поля нажмите значёк <i class="fas fa-trash"></i></small>
                </div>

                <div class="form-group row">
                    <label for="MainTextTextarea"><i class="fas fa-edit"></i> Текст новости</label>

                    <div class="input-group mb-3">
                        <textarea class="form-control" id="MainTextTextarea" aria-describedby="TextAreaHelp" rows="3" v-model="formData.mainText" required></textarea>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button" id="button-newsTextArea_trash" @click="formData.mainText = '' ">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <small id="TextAreaHelp" class="form-text text-muted">Данное поле используется для указания основного текста новости. Для очистки поля нажмите значёк <i class="fas fa-trash"></i></small>
                </div>

            </div>
             <!-- _____________________________________ -->

            <!-- Инпуты для секции Docs-->
            <div class="" id="docs" v-if="section.docsToggled">

                <div class="form-group row">
                    <label for="SectionInput"> <i class="fas fa-clipboard"></i> Раздел сайта</label>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="SectionInput" aria-describedby="SectionHelp" placeholder="К какому разделу относится документ" v-model="formData.theme" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button" id="button-section_trash" @click="formData.theme = '' ">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <small id="SectionHelp" class="form-text text-muted">Данное поле используется для указания раздела в который требуется внести изменение. Для очистки поля нажмите значёк <i class="fas fa-trash"></i></small>
                </div>

                <div class="form-group row">
                    <label for="UrlInput"><i class="fas fa-link"></i> URL</label>

                    <div class="input-group mb-3">
                        <input type="url" pattern="http://vemst.ru/*" class="form-control" id="UrlInput" aria-describedby="UrlHelp" placeholder="http://vemst.ru/..." v-model="formData.url" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button" id="button-docsUrl_trash" @click="formData.url = '' ">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <small id="UrlHelp" class="form-text text-muted">Данное поле используется для указания ссылки на страницу где требуется изменить / добавить документ. Для очистки поля нажмите значёк <i class="fas fa-trash"></i></small>
                </div>

            </div>
            <!-- _____________________________________ -->

            <!-- Инпуты секции Расписание -->
            <div class="" id="schedule" v-if="section.scheduleToggled">

                <div class="form-group row">
                    <label for="scheduleSelect"> <i class="fas fa-graduation-cap"></i> Выберите отделение</label>
                    <select class="form-control" id="scheduleSelect" v-model="formData.theme">
                        <option>Очное</option>
                        <option>Заочное</option>
                    </select>
                </div>

            </div>
            <!--_______________________________________-->

            <!-- Инпуты секции Другое -->
            <div class="" id="any" v-if="section.anyToggled">

                <div class="form-group row">
                    <label for="anyThemeInput"> <i class="fas fa-bullhorn"></i> Тема</label>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="anyThemeInput" aria-describedby="anyThemeHelp" placeholder="Тема" v-model="formData.theme" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button" id="button-anyTheme_trash" @click="formData.theme = '' ">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <small id="anyThemeHelp" class="form-text text-muted">Используйте данное поля для указания тематики вашего предложения. Для очистки поля нажмите значёк <i class="fas fa-trash"></i></small>
                </div>

                <div class="form-group row">
                    <label for="anyTextTextarea"><i class="far fa-clipboard"></i> Сообщение</label>

                    <div class="input-group mb-3">
                        <textarea class="form-control" id="anyTextTextarea" aria-describedby="anyTextAreaHelp" rows="3" v-model="formData.mainText" required></textarea>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button" id="button-anyTextArea_trash" @click="formData.mainText = '' ">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <small id="anyTextAreaHelp" class="form-text text-muted">Данное поле обязательно для заполнения. Опишите что именно вы хотите предложить. Для очистки поля нажмите значёк <i class="fas fa-trash"></i></small>
                </div>

            </div>
            <!--_______________________________________-->

            <!-- Примечание -->
            <div class="form-group row">
                <label for="DescriptionInput"> <i class="fas fa-book-reader"></i> Примечание</label>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" id="DescriptionInput" aria-describedby="DescriptionHelp" placeholder="Ваши пожелания..." v-model="formData.description">
                    <div class="input-group-append">
                        <button class="btn btn-outline-danger" type="button" id="button-addon2" @click="trashDescription">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <small id="DescriptionHelp" class="form-text text-muted">Данное поле используется для указания какиго-либо примечания или коментария. Для очистки поля нажмите значёк <i class="fas fa-trash"></i></small>
            </div>
            <!--_________________________________________-->

            <!-- Загрузка файлов -->
            <!--_________________________________________-->
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

                    any: 'Другое',
                    anyToggled: false,
                    anyDescription: 'Используйте данный раздел если другие Вам не подходят.',

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
                this.clearFormData();
            },

            /**
             * Очистка формы описания
             * хз зачем ввёл ибо всё остальное чистим прямо с инпута
             */
            trashDescription(){
                this.formData.description = '';
            },

            /**
             * Очистка формы для отправки
             */
            clearFormData(){
                this.formData.theme = '';
                this.formData.mainText = '';
                this.formData.file = [];
                this.formData.description = '';
                this.formData.url = '';
                this.formData.deadline = null;
            }
        }
    }
</script>

<style>
    .custom-file-label::after {
        content: none !important;
    }

</style>
