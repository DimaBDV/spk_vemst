<template>
    <div id="modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="exampleModalLongTitle">{{ section }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p v-if="theme !=='' ">{{ theme }}</p>
                    <p v-if="mainText !=='' ">{{ mainText }}</p>
                    <p v-if="description !=='' ">{{ description }}</p>
                    <p v-if="url !=='' ">{{ url }}</p>

                    <p v-if="file.length !== 0">Прикрепленные файлы</p>
                    <div v-if="file.length !== 0" v-for="item in file" class="card card-body">
                        <div class="row" v-if="item.image">
                            <div class="col">
                                <img :src="item.url" alt="..." class="img-thumbnail w-50">
                            </div>
                            <div class="col">
                                <p>{{item.name}}</p>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <i class="fas fa-file "></i>
                            <p>{{item.name}}</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" disabled>Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        mounted() {
            /**
             * Приём события openWaitingModal
             */
            this.$root.$on('openWaitingModal', data => {
                this.openModal(data);
            });


            $('#modal').on('hidden.bs.modal', data => {
                this.clearModal();
            })
        },
        data(){
            return{
                section: '',
                theme: '',
                mainText: '',
                file: [],
                description: '',
                url: '',
                deadline: null
            }
        },
        methods:{
            clearModal(){
                this.section= '';
                this.theme= '';
                this.mainText= '';
                this.file= [];
                this.description= '';
                this.url= '';
                this.deadline= null;
            },
            /**
             * Открыть модальное окно
             * @param data
             */
            openModal: function (data) {
                this.section = data.section;
                this.theme = data.theme;
                this.mainText = data.mainText;
                this.description = data.description;
                this.url = data.url;
                this.deadline = data.deadline;

                let files = JSON.parse(data.files);
                if (files !== 0) {
                    //    TODO: загрузка файлов превью или что-то около того
                    for(let item of files){
                        this.loadFile(item)
                    }
                }

                $('#modal').modal('show');
            },
            /**
             * Запрос информации по прикрепленным файлам
             * @param item
             */
            loadFile(item){
                axios.get('/webapi/file/show/' + item)
                    .then(response => {
                        this.checkFile(response.data);
                    })
                    .catch(error => {
                    //    TODO: вывод ошибки
                    });
            },
            /**
             * Проверяет что за файл, картинка или нет
             * @param file
             */
            checkFile(file){
                console.log('test regex ...' + file.type + ' '+ file.name)
                let reImage = new RegExp("image\\/");
                // let reApp = new RegExp("application\\/");

                if(reImage.test(file.type)){
                    this.file.push({
                        image: true,
                        name: file.name,
                        url: file.url
                    })
                }
                else{
                    this.file.push({
                        image: false,
                        name: file.name,
                        url: file.url
                    })
                }
            }
        }
    }
</script>
