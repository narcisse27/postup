<template>
    <div class="">

        <nav id="navbar-white" class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <User-Mini-Manager :currentTemplate.letter.adresse.sync="userData"></User-Mini-Manager>
            </div>
        </nav>



        <div id="wrapper">

            <!-- Sidebar -->
            <div id="slidebar-white" class="slidebar-nav">
                <nav id="navbar-white" class="navbar navbar-default" role="navigation">
                    <div class="">
                        <Side-Navbar v-model="myTemplates" :templates.sync="myTemplates" :currentTemplate.sync="currentTemplate"></Side-Navbar>
                    </div>
                </nav><!--/.navbar -->
            </div>
            <!--/.sidebar-nav -->


            <!-- Page Content -->
            <main id="page-wrapper6">
                <div class="container-fluid no-padding-left no-padding-right">
                    <div class="row no-padding-left no-padding-right">
                        <div class="col-lg-12 no-padding-left no-padding-right">
                            <div class="col-lg-12 well " id="project-name-wrapper" v-cloak>
                                <div class="col-lg-9">
                                    <div class="col-lg-1">
                                        <!--<h4><span class="ion-ios-folder-outline"></span></h4>-->
                                        <span>TITRE : </span>
                                    </div>
                                    <div class="form-group" v-bind:class="checkField(currentTemplate.name)">
                                        <div class="col-lg-11">
                                            <input type="text" class="form-control"  v-model="currentTemplate.name" v-on:keyup="checkIfCreateTemplate" placeholder="nomdutemplate" v-on:keyup.enter="createNewTemplate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div v-if="factoryTemplate"  class="ion-btn"  @click="createNewTemplate">
                                        <span class="ion-checkmark-round" title="enrengistrer ce template"></span>
                                    </div>
                                    <div v-else class="ion-btn" @click="updateThisTemplate(currentTemplate.id)" id="currentTemplate.id">
                                        <span class="ion-edit" title="mettre à jour les modifications"></span>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <p>
                                        Modèle mis à jour le {{ currentTemplate.updated_at }}
                                        <br>
                                        10/20
                                    </p>
                                </div>
                            </div>

                            <div class="row letter-padding">

                                 <div v-if="page == 'letter'" class="col-lg-6">
                                    <div id="letter-toolbar-wrapper"></div>
                                </div>

                                <div class="col-lg-9 card" id="letter-wrapper" v-if="page == 'letter'"  v-cloak>
                                    <div class="panel panel-default">
                                        <div class="panel-heading heading-custom">
                                            <div class="col-lg-12">
                                                <div class="col-lg-4">
                                                    <span> {{ currentTemplate.name }} </span>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div id="toolbar-wrapper"></div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <h4>
                                                        <span data-toggle="modal" data-target=".bs-letter-preview" @click="thisLetterToPdf" class="ion-eye pull-right ion-btn"></span>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div id="letter-content-scroll">
                                                <div id="sheet-paper" class="paper-sheet">
                                                    <div class="sender-data-wrapper row">
                                                        <div class="col-lg-6" id="sender-data">
                                                            <!-- lastname -->
                                                            <div class="col-lg-6" v-bind:class="checkAdresseField(currentTemplate.letter.adresse.lastname)">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control letter-fonts form-smaller-custom" placeholder="NOM" v-model="currentTemplate.letter.adresse.lastname" disabled="true" title="changez votre nom dans les paramètres de votre compte">
                                                                </div>
                                                            </div>
                                                            <!-- end lastname -->
                                                            <!-- firstname -->
                                                            <div class="col-lg-6" v-bind:class="checkAdresseField(currentTemplate.letter.adresse.firstname)">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control letter-fonts form-smaller-custom" placeholder="Prénom" v-model="currentTemplate.letter.adresse.firstname" disabled="true" title="changez votre prénom dans les paramètres de votre compte">
                                                                </div>
                                                            </div>
                                                            <!-- end firstname -->
                                                            <!-- adresse -->
                                                            <div class="col-lg-12" v-bind:class="checkAdresseField(currentTemplate.letter.adresse.adresse)">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-smaller-custom" placeholder="Adresse" v-model="currentTemplate.letter.adresse.adresse">
                                                                </div>
                                                            </div>
                                                            <!-- end adresse -->
                                                            <!-- npa -->
                                                            <div class="col-lg-4" v-bind:class="checkAdresseField(currentTemplate.letter.adresse.npa)">
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control form-smaller-custom" placeholder="npa" v-model="currentTemplate.letter.adresse.npa">
                                                                </div>
                                                            </div>
                                                            <!-- end npa -->
                                                            <!-- city -->
                                                            <div class="col-lg-8" v-bind:class="checkAdresseField(currentTemplate.letter.adresse.city)">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Ville" class="form-control form-smaller-custom" id="inputError" v-model="currentTemplate.letter.adresse.city">
                                                                </div>
                                                            </div>
                                                            <!-- end city -->
                                                            <!-- phone -->
                                                            <div class="col-lg-12" v-bind:class="checkAdresseField(currentTemplate.letter.adresse.phone)">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-smaller-custom" placeholder="07X 123 45 67" v-model="currentTemplate.letter.adresse.phone" v-mask="'999 999 99 99'">
                                                                </div>
                                                            </div>
                                                            <!-- end phone -->
                                                            <!-- email -->
                                                            <div class="col-lg-12"  v-bind:class="checkAdresseField(currentTemplate.letter.adresse.email)">
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control form-smaller-custom" placeholder="email" v-model="currentTemplate.letter.adresse.email" disabled="true" title="changez votre email dans les paramètres de votre compte">
                                                                </div>
                                                            </div>
                                                            <!-- end email -->
                                                        </div>
                                                        <div class="" id="letter-current-date-wrapper">
                                                            <div class="col-lg-12">
                                                                {{ currentTemplate.letter.adresse.city }}, le {{ currentTemplate.letter.currentDate }}
                                                            </div>
                                                        </div>
                                                        <!-- Adresse destinataire -->
                                                        <div class="col-lg-6" id="recipient-data">
                                                            <input type="text" class="form-control form-smaller-custom" placeholder="Madame, Monsieur" title="Remplacement automatique" disabled="true">
                                                            <input type="text" class="form-control form-smaller-custom" placeholder="Nom et prénom du destinataire" title="Remplacement automatique" disabled="true">
                                                            <input type="text" class="form-control form-smaller-custom" placeholder="Entreprise" title="Remplacement automatique" disabled="true">
                                                            <input type="text" class="form-control form-smaller-custom" placeholder="Adresse" title="Remplacement automatique" disabled="true">
                                                            <input type="text" class="form-control form-smaller-custom" placeholder="Npa et Ville" title="Remplacement automatique" disabled="true">
                                                        </div>
                                                        <!-- end Adresse destinataire -->
                                                    </div>

                                                    <div class="col-lg-12" id="letter-object-wrapper">
                                                        <input type="text" placeholder="Object" class="form-control form-smaller-custom" v-model="currentTemplate.letter.object">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div id="letter-personal-text">
                                                            <p><br><br></p>
                                                            <div id="letter-personal-content" class="form-control" >
                                                                <!--<div>{{ currentTemplate.letter.content }}</div>-->
                                                                <ckeditor v-model="currentTemplate.letter.content" :config="config"></ckeditor>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div id="letter-greetings">
                                                            <input type="text" class="form-control form-smaller-custom" value="Salutations dinstingués" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" id="signature-wrapper">
                                                        {{ currentTemplate.letter.adresse.firstname }} {{ currentTemplate.letter.adresse.lastname}}
                                                        <div id="signature-image"><!-- add here siganture feature --></div>
                                                    </div>
                                                    <div class="letter-appendicies-list col-lg-12">
                                                        <hr>
                                                        <strong>Annexes : </strong>
                                                        <ul>
                                                            <li v-for="appendice in currentTemplate.appendices"> {{ appendice.name }} </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade bs-letter-preview mailer-filter-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  v-cloak>
                                    <div class="modal-content" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Aperçu</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div id="letter-preview" class="col-lg-12" v-if="!preloadingPdf">
                                                    <object id="letter-preview-frame-data" data="" type="application/pdf" style="width: 60%; height: 70vh; margin-left: 20%;">
                                                        <embed id="letter-preview-frame" src="" type="application/pdf" style="width: 500px; margin: auto; height: auto"/>
                                                    </object>
                                                </div>
                                                <div v-else="">
                                                    <span class="fa fa-circle-o-notch"></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 card" v-if="page == 'letter'" >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            ANNEXES
                                        </div>
                                        <div class="panel-body">

                                            <ul class="col-lg-12">
                                                <div  v-for="appendice in currentTemplate.appendices">
                                                    <div class="col-lg-10">
                                                        <input type="text" v-on:keyup.enter="updateAppendiceName(appendice)" class="form-control" v-model="appendice.name">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <span class="ion-close-round ion-btn" @click="deleteAppendice(appendice)"></span>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                        <div class="panel-footer">
                                            <form action="" @submit.prevent="addAppendice">
                                                <label for="appendiceInputFile" class="pull-right">
                                                    <span class="ion-plus-round pull-right color-red"></span>
                                                </label>
                                                <input id="appendiceInputFile" type="file" @change="appendiceChanged" v-mask="'AAAAAAAAAAAAAAAAAAA'" class="form-control" style="display: none">
                                            </form>
                                            <br>
                                        </div>
                                    </div>
                                </div>

                                <div id="recipient-manger-col-wrapper"  v-if="page == 'mailer'"  v-cloak>
                                    <Recipient-manager></Recipient-manager>
                                </div>

                                <!-- Mailer -->
                                <Mailer v-model="page" :userData="userData" :template.sync="currentTemplate"></Mailer>
                                <!-- End Mailer -->

                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
</template>

<script>
    window.axios = require('axios');

    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var $ = require('jquery');
    import moment from 'moment';
    import AwesomeMask from 'awesome-mask';
    import Mailer from './Mailers/Mailer-widget.vue';
    import Recipientmanager from './Mailers/Recipient-manager';
    import Sidenavbar from './Navs/Default-Nav';
    import Ckeditor from 'vue-ckeditor2';
    import DefaultProjectNameBar from './Templates/Default-Project-Name-Bar';
    import UserMiniManager from './User/User-Mini-Manager';


    export default {
        components:{
            'Side-Navbar': Sidenavbar,
            'Mailer': Mailer,
            'Recipient-manager': Recipientmanager,
            'ckeditor': Ckeditor,
            'User-Mini-Manager': UserMiniManager,
            'Default-Project-Name-Bar' : DefaultProjectNameBar,
        },
        directives: {
            'mask': AwesomeMask
        },
        data() {
            return {
                config: {

                    language: 'fr',
                    removePlugins: 'elementspath',
                    resize_enabled: false,
                    height: 300,
                    extraAllowedContent:
                    {
                        span : {
                            attributes: ['contenteditable', 'title', 'class'],
                            classes: ['editableSpanners', 'postup-corporate-span', 'postup-appel-span'],
                            styles : ['background-color','color', 'margin-right', 'margin-left', 'border-radius']
                        },
                    },
                    extraPlugins: 'sharedspace,postupAutomatisator',
                    sharedSpaces: {
                        top: 'toolbar-wrapper'
                    },
                    toolbar: [
                        [ 'Bold', 'Italic', 'Underline', 'JustifyLeft' , 'JustifyCenter' , 'JustifyRight', 'JustifyBlock' ,'NumberedList', 'BulletedList', 'PostupAutomatisator']
                    ],

                },
                areaList: '',
                areasearch: '',
                currentTemplate: {
                    id: '',
                    name: '',
                    oldName: '',
                    letter: {
                        adresse: {
                            firstname: 'Prénom',
                            lastname: 'Nom',
                            adresse: 'Adresse',
                            npa: "npa",
                            city: "Ville",
                            phone: 'Téléphone',
                            email: 'email',
                            currentDate: ''
                        },
                        object: '',
                        content: ''
                    },
                    appendices:[
                        { id: 0 , name: 'cv.pdf', file: 'cv.pdf' },
                        { id: 1 , name: 'titre.pdf', file: 'titre.pdf' },
                        { id: 2 , name: 'attestation.pdf', file: 'attestation.pdf' }
                    ]
                },
                corporateFiltered: '',
                corporatesearch: '',
                defaultTemplate: '',
                factoryTemplate: '',
                loadingdata: false,
                modalShow: true,
                mailsearch: '',
                mailsToSend: [],
                myTemplates: [],
                namesearch: '',
                preloadingPdf: true,
                page: 'letter',
                regionsearch: '',
                selectedTemplateId: '',
                sendable : true,
                searchError: null,
                templateName: '',
                templateNameOld: '',
                templateCreateNew : false,
                template: [],
                userKey: '',
                userId: '',
                userLastname: '',
                userData: [],
                userAdresse: {}

            }
        },
        created(){
            this.userKey = document.getElementById('userKey').value;
            // get user data
            axios.get('/api/user?api_token='+this.userKey).then( (response) => {
                //console.log(response);
                this.userId = response.data.id;
            this.userData = response.data;
            this.currentTemplate.letter.adresse.firstname = response.data.firstname;
            this.currentTemplate.letter.adresse.lastname = response.data.lastname;
            this.currentTemplate.letter.adresse.adresse = response.data.adresse;
            this.currentTemplate.letter.adresse.npa = response.data.npa;
            this.currentTemplate.letter.adresse.city = response.data.city;
            this.currentTemplate.letter.adresse.phone = response.data.phone;
            this.currentTemplate.letter.adresse.email = response.data.email;
            this.currentTemplate.updated_at = moment(String(response.data.updated_at)).format('DD/MM/YYYY à hh:mm');
        });
            // end get user data
            var content;
            if(this.$route.params.type == "usine")
            {
                axios.get('api/factorytemplate/convertSlug/'+this.$route.params.slug+'?api_token='+this.userKey)
                        .then((response) => {
                    console.log(response.data.id);
                this.loadThisFactoryTemplate(response.data.id);
                console.log()
            })
            .catch((error) => {
                console.log(error);
                //this.showLoadTemplateError();
                alert('error convert factory slug');
            });
                this.factoryTemplate = true;
            }

            if(this.$route.params.type == "mix")
            {

                axios.get('api/template/convertSlug/'+this.$route.params.slug+'?api_token='+this.userKey)
                        .then((response) => {
                    console.log(response.data);
                this.loadThisTemplate(response.data);
            })
            .catch((error) => {
                console.log(error);
                //this.showLoadTemplateError();
                alert('error convert slug');
            });
                this.factoryTemplate = false;
            }
            this.refreshTemplateManager(); // refresh all data in template manager
            moment.locale('fr');
            this.currentTemplate.letter.currentDate = moment().format('LL');


        },
        mounted() {
            this.preloadingPdf = false;

        },
        watch: {
            mailsearch : function(){
                if(this.mailsearch != ""){
                    this.sendable = true;
                }else{
                    this.sendable = false;
                }
                if(this.mailsToSendlength > 0){
                    this.sendable = true;
                }else{
                    this.sendable = false;
                }
            },
            '$route': function(newRoute, oldRoute)
            {

                if(newRoute.params.type === "usine")
                {
                    axios.get('api/factorytemplate/convertSlug/'+newRoute.params.slug+'?api_token='+this.userKey)
                            .then((response) => {
                        console.log(response.data);
                    this.loadThisFactoryTemplate(esponse.data.id); // load this factory template
                })
                .catch((error) => {
                    console.log(error);
                    //this.showLoadTemplateError();
                    console.log('error convert factory slug');
                });
                    this.factoryTemplate = true;

                }


                if(newRoute.params.type === "mix")
                {
                    axios.get('api/template/convertSlug/'+newRoute.params.slug+'?api_token='+this.userKey)
                            .then((response) => {
                        console.log(response.data);
                    this.loadThisTemplate(response.data); // load this private factory template
                })
                .catch((error) => {
                    console.log(error);
                    //this.showLoadTemplateError();
                    console.log('error convert slug');
                });

                    this.factoryTemplate = false;
                }
            },
        },
        computed: {
        },
        methods: {

            refreshAppendice: function()
            {
                axios.get('/api/appendice/'+this.currentTemplate.id+'?api_token='+this.userKey, {

                })
                        .then((response) => {
                    //console.log(response.data);
                    this.currentTemplate.appendices = response.data;
            })
                .catch((error) => {
                //console.log(error.response.data.message);
            });
            },
            updateAppendiceName: function(appendice){
                axios.put('/api/appendice/'+appendice.id+'/?api_token='+this.userKey, {
                    id: appendice.id,
                    name: appendice.name
                })
                        .then((response) => {
                    //console.log(response.data);
                    this.refreshTemplateManager(); // refresh all data in template manager
                this.refreshAppendice();

            })
                .catch((error) => {
                    //console.log(error.response.data.message);
                });
            },
            appendiceChanged: function(e)
            {
                console.log(e.target.files[0].name);
                var fileName = e.target.files[0].name;
                var type = e.target.files[0].type;
                var fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                var newAppendice = {};
                axios.post('/api/appendice?api_token='+this.userKey, {
                    appendice : e.target.result,
                    extension: type,
                    name: fileName,
                    templateId : this.currentTemplate.id,
                })
                        .then((response) => {
                    //console.log(response.data);
                    this.refreshAppendice(); // refresh all appendices in appendices manager
                this.refreshTemplateManager(); // refresh all data in template manager
                $('#appendiceInputFile').val(""); //  empty input value

            })
            .catch((error) => {
                    //console.log(error.response.data.message);
                });
            }
            },
            deleteAppendice: function(appendice)
            {
                axios.delete('/api/appendice/'+appendice.id+'/?api_token='+this.userKey, {

                })
                        .then((response) => {
                    console.log(response.data);
                this.refreshTemplateManager(); // refresh all data in template manager
                this.refreshAppendice();
                if(error.response.data.code == 409){
                    console.log(error.response.data.message);
                    this.showAddAppendiceError();
                }else{


                }
                // TODO succes message
            })
                .catch((error) => {

            });
            },
            checkField: function(data)
            {
                if(data.length < 3 || data == "" || data == undefined){
                    return 'has-warning';
                }else{
                    return '';
                }
            },
            checkAdresseField: function(data)
            {
                if(data == undefined || data.length <= 2 || data == "")
                {
                    //console.log('error : '+data);
                    return 'has-warning';
                }else{
                    return '';
                }
            },
            checkIfCreateTemplate: function()
            {
                if(this.templateName != this.templateNameOld)
                {
                    this.templateCreateNew = true;

                }else
                {
                    this.templateCreateNew = false;
                }
            },
            dataToTemplate: function(data)
            {
                this.currentTemplate.id = data.id;
                this.currentTemplate.name = data.name;
                this.currentTemplate.oldName = data.name;
                this.currentTemplate.letter.object = data.object;
                this.currentTemplate.letter.content = data.content;
                this.currentTemplate.updated_at = moment(String(data.updated_at)).format('DD/MM/YYYY à hh:mm');
                this.templateName = data.name;
                this.templateNameOld = data.name;
                this.selectedTemplateId = data.id; // for template manager selected elements
            },
            createNewTemplate: function()
            {
                if(this.templateName == "" ||
                        this.currentTemplate.letter.object == "" ||
                        this.currentTemplate.letter.content == "" ||
                        this.currentTemplate.letter.adresse.adresse == "" ||
                        this.currentTemplate.letter.adresse.npa == "" ||
                        this.currentTemplate.letter.adresse.city == "" ||
                        this.currentTemplate.letter.adresse.phone == "" )
                {
                    this.showTemplateFillError();
                }else
                {

                    axios.post('/api/template?api_token='+this.userKey, {
                        user_id: this.userId,
                        name : this.currentTemplate.name,
                        object: this.currentTemplate.letter.object,
                        content : this.currentTemplate.letter.content,
                        adresse: this.currentTemplate.letter.adresse.adresse,
                        npa: this.currentTemplate.letter.adresse.npa,
                        city: this.currentTemplate.letter.adresse.city,
                        phone: this.currentTemplate.letter.adresse.phone,

                    })
                            .then((response) => {
                        //console.log(response.data);
                        this.refreshTemplateManager(); // refresh all data in template manager
                    this.showSuccessNotification({message: response.data.message});
                })
                .catch((error) => {
                    //console.log(error.response.data.message);
                    this.showErrorNotification({message: error.response.data.message});

                });

                }

            },
            updateThisTemplate: function(id)
            {
                this.template.name = this.templateName;
                axios.patch('api/template/'+id+'?api_token='+this.userKey, {
                    id: this.currentTemplate.id,
                    name: this.currentTemplate.name,
                    content: this.currentTemplate.letter.content,
                    object: this.currentTemplate.letter.object,

                })
                        .then((response) => {
                        this.refreshTemplateManager(); // refresh all data in template manager
                        this.showTemplateUpdateSuccess();
                        this.currentTemplate.updated_at = moment().format('DD/MM/YYYY à HH:mm');

                })
                .catch((error) => {
                console.log(error);
                //TODO: add error msg
            });

            },
            loadThisTemplate: function(id)
            {


                axios.get('api/template/'+id+'?api_token='+this.userKey, {

                })
                        .then((response) => {
                    console.log(response.data);
                this.currentTemplate.letter.currentDate = moment().format('LL');
                this.dataToTemplate(response.data);
                this.refreshAppendice();
                //var editor = tinymce.get('letter-personal-content'); TODO delete when handmande wysiwig ok
                //editor.setContent( this.currentTemplate.letter.content ); //TODO delete when handmande wysiwig ok change dinamicly tiny content

            })
                .catch((error) => {
                console.log(error);
                this.showLoadTemplateError();
            });

            },
            loadThisFactoryTemplate: function(id)
            {


                axios.get('api/factorytemplate/'+id+'?api_token='+this.userKey, {

                })
                        .then((response) => {
                    console.log(response.data);
                this.currentTemplate.letter.currentDate = moment().format('LL');
                this.dataToTemplate(response.data);
                this.refreshAppendice();
            })
                .catch((error) => {
                console.log(error);
                this.showLoadTemplateError();
            });

            },

            refreshTemplateManager: function ()
            {
                axios.get('api/template?api_token='+this.userKey, {
                })
                        .then((response) => {
                    this.myTemplates = response.data[0];
            })
                .catch((error) => {
                //console.log(error);
                this.ShowRefreshTemplatesError();
            });
            },
            thisLetterToPdf: function(div){
                axios.get('/api/generate/pdf/'+this.currentTemplate.id+'/?api_token='+this.userKey)
                        .then((response) => {
                    console.log('response pdf controller');
                console.log(response.data);

                $('#letter-preview-frame').attr('src', 'temp/'+response.data.pdf_name);
                $('#letter-preview-frame-data').attr('data', 'temp/'+response.data.pdf_name);
                // TODO add success message
            })
                .catch((error) => {
                    console.log(error);
                //TODO: add error msg
            });
            }
        },
        notifications: {
            showErrorNotification: {
                title: "Oups!",
                message: "Une erreur est suvenue",
                type: "error"
            },
            showSuccessNotification: {
                title: 'Succès!',
                message: 'Super, votre action a été confirmée',
                type: 'success'
            },
            showTemplateExistError: {
                title: 'Oups!',
                message: 'Un tempalte a déjà ce nom, veuillez en choisir un autre',
                type: 'error'
            },
            showTemplateCreateSuccess: {
                title: 'Super!',
                message: "le template a bien été crée!",
                type: 'success' //Default: 'info', also you can use VueNotifications.type.error instead of 'error'
            },
            showTemplateCreateError: {
                title: 'Oups!!',
                message: "le template n'a pas pu être crée!",
                type: 'error' //Default: 'info', also you can use VueNotifications.type.error instead of 'error'
            },
            showTemplateUpdateSuccess: {
                title: 'Super!',
                message: 'Le modèle a bien été mise à jour',
                type: 'success' //Default: 'info', also you can use VueNotifications.type.error instead of 'error'
            },
            showTemplateDeleteSuccess: {
                title: 'Succès!',
                message: 'le template a bien été supprime!',
                type: 'success' //Default: 'info', also you can use VueNotifications.type.error instead of 'error'
            },
            showTemplateDuplicateSuccess: {
                title: 'Succès',
                message: 'le template a bien été dupliqué',
                type: 'success'
            },
            showTemplateDuplicateError: {
                title: 'Oups!',
                message: "Nous ne pouvons pas dupliquer ce tempalte",
                type: 'error'
            },
            showTemplateFillError: {
                title: 'Oups!',
                message: 'Remplissez tous les champs pour enrengistrer ce template ',
                type: 'error',
            },
            showGetUserAdresseError: {
                title: 'Oups!',
                message: "Une erreur s'est produite lors du chargement de votre adresse",
                type: 'error'
            },
            ShowRefreshTemplatesError: {
                title: 'Oups!',
                message: "Une erreur s'est produite lors du chargement de vos templates",
                type: 'error'
            },
            showLoadTemplateError: {
                title: 'Oups!',
                message: "Une erreur s'est produite lors du chargement de ce tempalte, veuillez actualiser la page.",
                type: 'error'
            },
            showAddAppendiceError: {
                title: 'Oups!',
                message: "Seulement 8 piéces jointes par modèle sont accetpés",
                type: 'error'
            }
        }
    }
</script>
<style>
    only screen and (min-width: 980px)
    {
        body{
            overflow-y: hidden!important;
        }

    }
    #template-list-wrapper {
        /*visibility: hidden;*/
    }
    #project-name-wrapper{
        height: 70px;
        background-color: #dadada;
    }
    [v-cloak] {
        display: none;
    }
    #recipient-manger-col-wrapper{
        opacity: 1;
        transition: opacity 1s ease-in-out;
        -webkit-transition: opacity 1s ease-in-out;
        -moz-transition: opacity 1s ease-in-out;
        -ms-transition: opacity 1s ease-in-out;
        -o-transition: opacity 1s ease-in-out;
    }
    .template-manager-selected-template{
        background-color: #2ab27b!important;
        transition: 100ms;
    }
    #letter-personal-text{
        height: 100mm;
    }
    #letter-wrapper .panel-body{
        height: 80vh;
        overflow-y: scroll;
    }

    #recipient-data{
        margin-left: 57%;
    }
    .to-deliver-list-item:hover{
        color: red!important;
        transition: 100ms;
        cursor: pointer;
    }
    #letter-object-wrapper{
        margin-top: 9.5%;
    }

    .corporate-list-item:hover{
        cursor: pointer;
        color: #2ab27b;
        transition: 100ms;
    }
    .corporate-list-item{
        transition: 100ms;
    }
    .heading-custom{
        background-color: #f1f1f1!important;
        height: 40px;
    }
    .modal-large{
        width: 80%;
        margin-left: 10%;
        margin-right: 10%;
    }
    #letter-wrapper{
        height: 80vh;
    }
    .mailer-wrapper input{
        width: 100%;
        height: auto;
    }
    .mailer-wrapper{
        width: 100%;
        height: auto;
    }
    .ion-btn{
        transition: 100ms;
    }
    .ion-btn:hover{
        color: #0c84e4;
        transition: 100ms;
        cursor: pointer;
    }
    .template-manager-header{
        width: 100%;
        height: 20px;
    }
    .template-manager-temp-name{
        width: 70%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 12px!important;
        float: left;
        cursor: pointer;
    }
    .template-manager-temp-icons{
        width: 11%;
        padding-left: 2%;
        padding-right: 2%;
        float: left;
    }
    #letter-toolbar-wrapper{
        width: 100%;
        height: auto;
    }
    #toolbar-wrapper{
        top: 0px!important;
    }
    .letter-fonts{
        font-size: 12pt!important;
    }
    #letter-content-scroll{
        width: 100%;
        height: auto;
        display: inline-block;
        overflow: hidden;
    }
    #sheet-paper{
        margin-left: auto;
        margin-right: auto;
        overflow: hidden;
    }
    .paper-sheet{
        size: A4;
        margin: auto;
        width: 793px;
        height: 1122px;
        padding-left: 132px;
        padding-right: 94px;
        padding-top: 94px;
        padding-bottom: 94px;
        -webkit-box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        -moz-box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        -moz-box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        font-size: 10pt!important;
    }
    .paper-sheet .form-control{
        font-size: 10pt!important;

    }

    #sender-data-wrapper{
        width: 50%;
    }
    #letter-current-date-wrapper{
        margin-left: 57%;
    }

    .letter-appendicies-list{
        bottom: 0;
        width: 100%;
        height: auto;
    }
    #letter-preview-frame{
        width: 60%;
        margin-left: 20%;
        height: auto;
        margin: auto;
    }
    #letter-preview-frame-data{
        display: block;
        float: left;
        width: 60%;
        margin-left: 20%;
        margin-right: 20%;
        margin: auto;
        height: auto;
    }
    .form-smaller-custom{
        font-size: 12pt!important;
        height: 16px!important;
    }
    .templates-list{
        width: 100%;
        height: auto;
    }
    .templatelistappear-enter-active{
        animation: templatelistappear;
        animation-duration: 1s;
    }
    #letter-personal-content{
        height: auto;
    }
    #signature-wrapper{
        margin-left: 57%;
        height: auto;
        margin-top: 50px;
    }
    #signature-image{
        width: 100%;
        height: 40%;
        background-color: #a6e1ec;
    }
    .auto-value-letter{
        background-color: #a6e1ec;
    }

    .templatelistappear-leave-active{

        animation: templatelistdisappear;
    }
    .letter-padding{
        padding-left: 80px;
        padding-right: 50px;
    }

    /* CKEDITOR */
    .cke_top{
        border: 0px!important;
        background-color: #f1f1f1!important;
        zoom: 0.8!important;
    }
    .cke_chrome {
        display: block;
        border: 0px!important;
        padding: 0;
    }
    .color-red{
        color: #fe0364;
    }
    .mini-toastr__notification{
        width: 100%!important;
        top: 0px!important;
        right: 0px!important;

    }
    .-success{
        background-color: darkred!important;
    }
    .editableSpanners{
        background-color: #fe0364;
        color: white;
        border-radius: 5px;
    }

</style>
