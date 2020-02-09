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
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.docs; section.toggled = true; section.docsToggled = true">
                    <!--<i class="far fa-file"></i>-->
                    {{ section.docs }}
                </button>
            </div>

            <div class="col-12 col-sm-3 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.news; section.toggled = true; section.newsToggled = true">
                    <!--<i class="far fa-sticky-note"></i>-->
                    {{ section.news }}
                </button>
            </div>

            <div class="col-12 col-sm-3 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.schedule; section.toggled = true; section.scheduleToggled = true">
                    <!--<i class="far fa-list-alt"></i>-->
                    {{ section.schedule }}
                </button>
            </div>

            <div class="col-12 col-sm-3 py-1">
                <button class="btn btn-outline-primary btn-block" @click="formData.section = section.any; section.toggled = true; section.anyToggled = true">
                    <!--<i class="fas fa-info"></i>-->
                    {{ section.any }}
                </button>
            </div>

        </div>
        <!-- ______________________________________________________________________ -->
        <hr class="row">

        <!-- Описание в окне уведомления -->
        <div v-if="section.toggled" class="alert alert-warning alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Описание раздела</h4>
            <p v-if="section.newsToggled">{{ section.newsDescription }}</p>
            <p v-if="section.scheduleToggled">{{ section.scheduleDescription }}</p>
            <p v-if="section.docsToggled">{{ section.docsDescription }}</p>
            <p v-if="section.anyToggled">{{ section.anyDescription }}</p>

            <hr>
            <p class="mb-0">Просим серьёзно отнестись к вышеуказанным требованиям.
                <br>
                Это облегчит работу каждой из сторон и повысит продуктивность.
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
                    <small id="ThemeHelp" class="form-text text-muted">Данное поле используется для указания темы новости. Для очистки поля нажмите значок <i class="fas fa-trash"></i></small>
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
                    <small id="TextAreaHelp" class="form-text text-muted">Данное поле используется для указания основного текста новости. Для очистки поля нажмите значок <i class="fas fa-trash"></i></small>
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
                    <small id="SectionHelp" class="form-text text-muted">Данное поле используется для указания раздела, в который требуется внести изменение. Для очистки поля нажмите значок <i class="fas fa-trash"></i></small>
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
                    <small id="UrlHelp" class="form-text text-muted">Данное поле используется для указания ссылки на страницу, где требуется изменить или добавить документ. Для очистки поля нажмите значок <i class="fas fa-trash"></i></small>
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
                    <small id="anyThemeHelp" class="form-text text-muted">Используйте данное поля для указания тематики вашего предложения. Для очистки поля нажмите значок <i class="fas fa-trash"></i></small>
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
                    <small id="anyTextAreaHelp" class="form-text text-muted">Данное поле обязательно для заполнения. Опишите что именно вы хотите предложить. Для очистки поля нажмите значок <i class="fas fa-trash"></i></small>
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
                <small id="DescriptionHelp" class="form-text text-muted">Данное поле используется для указания какого-либо примечания или комментария. Для очистки поля нажмите значок <i class="fas fa-trash"></i></small>
            </div>
            <!--_________________________________________-->
            <hr class="row">
            <!-- Загрузка файлов -->
            <div class="form-group row d-block">
                <p class="mb-2"><i class="fas fa-upload"></i> Загрузка файлов </p>
                <div class="custom-file" >
                    <!-- FIXME: Очистка поля ввода путём переустановки type="" для возможности загрузить один и тот же файл -->
                    <input :type="input_file_type" name="file" class="custom-file-input" id="customFile" multiple aria-describedby="UploadHelp" v-on:change="fileInputChange($event)">
                    <label class="custom-file-label" for="customFile">Выберите файлы</label>
                    <small id="UploadHelp" class="form-text text-muted pt-3">Для выбора прикрепляемых файлов кликните по полю выше. Загрузка файлов на сервер будет произведена автоматически. Максимальный размер одного файла 30Мб</small>
                </div>

            </div>
            <!--_________________________________________-->

            <!-- Блок с информацией по загружаемым файлам -->
            <div class="form-group row d-block" v-if=" fileData.current !== '' ">
                <div class="progress w-100" >
                    <div class="progress-bar" role="progressbar" :style="{ width: fileData.progress + '%' }">{{ fileData.current }} %</div>
                </div>
                <!-- TODO: после прода ввести функцию отмены и возобновления загрузки -->
                <!--<button class="btn btn-outline-danger" @click="cancel">Отмена загрузки</button>-->
                <!--<button class="btn btn-outline-success" @click="retryUpload">Повторить отправку</button>-->
            </div>
            <!--_________________________________________-->

            <!-- Блок работы с загруженными файлами -->
            <div class="form-group row pt-3 d-block">
                <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Работа с файлами
                </button>
                <div class="collapse mt-2" id="collapseExample">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <p class="h3 text-center">Очередь</p>
                                <hr/>
                                <p class="text-muted text-center" v-if="fileData.order.length === 0"> Контейнер пуст </p>
                                <ul class="list-unstyled" v-for="item in fileData.order">
                                    <li>{{item.name }}</li>
                                </ul>

                            </div>
                            <div class="col-12 col-md-6">
                                <p class="h3 text-center">Загружены</p>
                                <hr/>
                                <p class="text-muted text-center" v-if="fileData.finish.length === 0"> Контейнер пуст </p>
                                <ul class="list-unstyled" v-for="(item, index) in fileData.finish">
                                    <li>{{item.name }}
                                        <button class="btn btn-outline-danger btn-sm" @click="removeAttachFile(index)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <hr class="row" v-if="fileData.failed.length !== 0"/>
                        <div class="row" v-if="fileData.failed.length !== 0">
                            <div class="col">
                                <p class="h3 text-center">Ошибка загрузки</p>
                                <hr/>
                                <div v-for="item in fileData.failed">
                                    <div class="row">
                                        <div class="col-12 col-md-6">{{item.name}}</div>
                                        <div class="col-12 col-md-6">{{item.error}}</div>
                                    </div>
                                    <hr/>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group row pt-3">
                <button :disabled="button_disabled" type="button" class="btn btn-outline-primary btn-lg btn-block" @click="sendForm"> <i class="fas fa-fire-alt"></i> Отправить</button>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    const CancelToken = axios.CancelToken;
    let cancel;

    export default {
        mounted() {
            // console.log('Component mounted.');
            // axios.defaults.withCredentials = true;
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
                    scheduleDescription:'Данный раздел предназначен для внесения изменений в расписании занятий по отделениям (Очное и Заочное).',

                    docs: 'Документы',
                    docsToggled: false,
                    docsDescription:'Данный раздел предназначен для документации, положений, РУМО и т.д. Заполняя данный раздел, пожалуйста, укажите ссылку страницы, на которой требуется изменить или добавить документ.',

                    any: 'Другое',
                    anyToggled: false,
                    anyDescription: 'Используйте данный раздел, если другие Вам не подходят.',

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
                },
                fileData:{
                    order: [],
                    finish: [],
                    progress: 0,
                    current: '',
                    failed: []
                },

                /**
                 * КОНСТАНТЫ
                 */
                MAX_FILE_SIZE: 30000000, // 30 Мб

                button_disabled: false,
                input_file_type: 'file'

            }
        },
        methods:{
            /**
             * Создаём событие и отправляем данные на $root компонент
             * Используется для предачи данных о созданных "предложениях" между компонентами
             *
             * Подробнее читай в Docs\front\offerEmit
             */
            sendOfferDataOnRootEmit(responceData){
                this.$root.$emit('newOffer', responceData)
            },
            /**
             * Удаление прикреплённого файла
             */
            removeAttachFile(item){
                this.fileData.finish.splice(item,1);
                this.formData.file.splice(item,1);
            },

            /**
             * Очистка всех указателей и перевод в default
             */
            clearSection(){
                this.formData.section = 'Выберите раздел';
                this.section.toggled = false;

                this.section.newsToggled = false;
                this.section.scheduleToggled = false;
                this.section.docsToggled = false;
                this.section.anyToggled = false;
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
            },
            /**
             * Очитска пормы с файлами
             */
            clearFileData(){
                this.input_file_type = 'text';
                this.input_file_type = 'file';

                this.fileData.order = [];
                this.fileData.finish = [];
                this.fileData.progress = 0;
                this.fileData.current = '';
                this.fileData.failed = [];
            },

            /**
             * База для загрузки файлов, проверяет инпут и при изменении начинает работать
             */
            async fileInputChange(event){

                this.button_disabled = true; //Блокируем кнопку отправки пока идёт завгрузка

                let files = Array.from(event.target.files);
                this.fileData.order = files.slice();

                for(let item of files){
                    if(item.size < this.MAX_FILE_SIZE){
                        await this.uploadFile(item);
                    }
                    else{
                        this.fileData.order.splice(item, 1);
                        this.fileData.failed.push({
                            file: item,
                            name: item.name,
                            error: 'Данный файл превышает лимит в 30Мб'
                        });

                        // console.error('Файл - ' + item.name + ' превышает 30 Мб');
                    }
                }

                this.button_disabled = false; // как только асинхронка закончит выполнение возвращаем кнопку
            },

            /**
             * Отправка файлов на сервер
             * @param item
             * @return {Promise<void>}
             */
            async uploadFile(item){

                let form = new FormData();
                form.append('file', item);

                await axios.post('/webapi/upload', form, {
                    /**
                     * Отмена загрузки
                     */
                    cancelToken: new CancelToken(function executor(c) {
                        cancel = c;
                    }),
                    onUploadProgress: (itemUpload) => {
                        this.fileData.progress = Math.round( ( itemUpload.loaded /itemUpload.total ) * 100 );
                        this.fileData.current = item.name + ' ' + this.fileData.progress;
                    }
                })
                .then(response => {
                    this.fileData.progress = 0;
                    this.fileData.current = '';
                    this.fileData.finish.push(item);
                    this.fileData.order.splice(item, 1);

                    this.formData.file.push(response.data.id);

                    //console.info(response.data);
                })
                .catch(error => {

                    this.fileData.progress = 0;
                    this.fileData.current = '';
                    this.fileData.failed.push({
                        file: item,
                        name: item.name,
                        error: error.response.data.errors
                    });
                    this.fileData.order.splice(item, 1);

                })
            },
            //  TODO: после прода ввести функцию отмены загрузки
            // /**
            //  * Вроде как отмена работы axiox
            //  */
            // cancel () {
            //     cancel();
            // },
            //
            /**
             * Повторная попытка загрузки файлов из @var this.fileData.order
             * @return {Promise<void>}
             */
            async retryUpload()
            {
                for(let item of this.fileData.order){
                    await this.uploadFile(item);
                }
            },

            /**
             * Отправка формы offer
             */
            async sendForm(){
                this.button_disabled = true; //Блокируем кнопку отправки пока идёт завгрузка

                let form = new FormData();
                form.append('section', this.formData.section);
                form.append('theme', this.formData.theme);
                form.append('mainText', this.formData.mainText);
                form.append('files', JSON.stringify( this.formData.file ) ); //Требуется парсинг на стороне сервера
                form.append('description', this.formData.description);
                form.append('url', this.formData.url);
                form.append('deadline', this.formData.deadline);

                await axios.post('/webapi/createnewoffer', form)
                    .then(response => {
                        this.clearOffer(); // полная очистка
                        this.sendOfferDataOnRootEmit(response.data);
                    })
                    .catch(error => {
                    //    TODO: обработка ошибок валидации и http error
                    });

                this.button_disabled = false; // как только асинхронка закончит выполнение возвращаем кнопку
            },

            /**
             * Полная очистка данных
             */
            clearOffer(){
                this.clearFormData();
                this.clearFileData();
                this.clearSection();

            }
        }
    }
</script>

<style>
    .custom-file-label::after {
        content: none !important;
    }

</style>
