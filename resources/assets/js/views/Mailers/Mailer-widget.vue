<template lang="html">
    <div id="mailer-col-wrapper" class="col-lg-3">
        <div class="panel panel-default card">
            <div class="panel-heading">
                <h5>Envoi</h5>
            </div>
            <div class="panel-body">
                <div class="mailer-wrapper">
                    <div class="mailer-destination-wraper col-lg-12">
                        <div class="col s1">
                            <strong>{{ selectedEmailsNb }}/{{ userData.mails_reserve }}</strong>
                        </div>
                        <div class="col-lg-9">
                            <multiselect v-model="value" tag-placeholder="ajouter adresse" SelectLabel="Enter/tab pour séléctionner" SelectedLabel="Selectionné" DeselectLabel="Supprimer" placeholder="Chercher ou ajouter une adresse mail" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag" :max="userData.mails_reserve" @search-change="reloadCorporates" noResult="Aucun résultat" :HideSelected="true"></multiselect>
                        </div>
                        <div class="col-lg-1 ion-btn">
                            <!-- v-if="page = 'letter'"  -->
                            <div class="ion-btn">
                                <a href="" @click.prevent="goToMailer">
                                    <span class="ion-navicon-round"></span>
                                </a>
                            </div>
                            <!-- v-if="page == 'mailer'"  -->
                            <div class="ion-btn">
                                <a href="" @click.prevent="goToLetter">Letter</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Objet" v-model="currentTemplate.mailer.object">
                    </div>
                    <div class="col-lg-12" id="mailer-content-toolbar"></div>
                    <div class="col-lg-12">
                        <ckeditor v-model="currentTemplate.mailer.content" :config="configMailer"></ckeditor>
                    </div>
                </div>
                <button class="btn pull-right" @click="mailerSendToMe">Send Me</button>
                <button class="btn pull-right" :disabled="sendable == true ? false : true" @click="sendThisMailer">
                    <span class="ion-android-send"></span>
                </button>
            </div>
        </div>
        <div v-if="showModal">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-container">

                            <div class="modal-header">
                                <slot name="header">
                                    <h1>Votre pierre à l'édifice!</h1>
                                    <p>
                                        Hey! les adresses suivantes ne sont pas référencées dans nos listes : <br>
                                    </p>
                                    <p>
                                        Vous pouvez aider les membres de la communauté de Postup en partageant ces dernières en y ajoutant quelques informations pratiques, celà ne vous prendra que quelques secondes!
                                        <br>
                                        Fournissez nous les infromations nécéssaires sur ce destinataire afin que nous puissions personaliser le contenu de votre postulation.
                                    </p>

                                </slot>
                            </div>

                            <div class="modal-body">
                                <slot name="body">
                                    <div class="row">
                                        <div v-for="corporate in corporatesToAdd">
                                            <h5>{{ corporate.email }}</h5>
                                            <form action="" class="form-horizontal" >

                                                <div class="col-md-3">
                                                    <div class="form-group " v-bind:class="checkField(corporate.name)">
                                                        <label for="inputName" class="control-label">Nom d'entreprise*</label>
                                                        <input type="text" class="form-control" id="inputName" placeholder="postup" v-model="corporate.name">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group" >
                                                        <label for="inputFirstname" class="control-label">Prénom</label>
                                                        <input type="text" class="form-control" id="inputFirstname" placeholder="Doe" v-model="corporate.firstname">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="inputLastname" class="control-label">Nom</label>
                                                        <input type="text" class="form-control" id="inputLastname" placeholder="John" v-model="corporate.lastname">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="inputSexe">Sexe</label>
                                                        <select class="form-control" name="" id="inputSexe" v-model="corporate.sexe">
                                                            <option value="2">Femme</option>
                                                            <option value="1">Homme</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group"  v-bind:class="checkField(corporate.city)">
                                                        <label for="inputCity" class="control-label">Ville*</label>
                                                        <input type="text" class="form-control" id="inputCity" placeholder="Ville" v-model="corporate.city">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group"  v-bind:class="checkField(corporate.adresse)">
                                                        <label for="inputAdresse" class="control-label">Adresse*</label>
                                                        <input type="text" class="form-control" id="inputAdresse" placeholder="Adresse" v-model="corporate.adresse">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <div class="form-group" v-bind:class="checkField(corporate.npa)">
                                                            <label for="inputNpa" class="control-label">Npa*</label>
                                                            <input type="text" class="form-control" id="inputNpa" placeholder="Npa" v-model="corporate.npa">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label  for="">Regions</label>
                                                        <input list="regions" name="region_filter" id="" class="form-control" type="text" v-model="corporate.canton" v-on:keyup="regionSearch(corporate.canton)">-->
                                                        <datalist id="regions">
                                                            <select>
                                                                <option v-for="region in regionList" v-bind:value="region.name" v-on:keyup.enter="regionSearch">{{ region.name }} - {{ region.abbreviation}}</option>
                                                            </select>
                                                        </datalist>

                                                    </div>
                                                </div>


                                                <div class="col-lg-6 offset-col-lg-3">
                                                    <div class="form-group">
                                                        <label class="control-label" for="">Domaines</label>
                                                        <input list="areas" type="text" class="form-control" v-model="corporate.area" v-on:keyup="areaSearch(corporate.area)" >
                                                        <datalist id="areas">
                                                            <select>
                                                                <option v-for="area in areaList" v-bind:value="area.name">{{ area.name }}</option>
                                                            </select>
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </slot>
                            </div>

                            <div class="modal-footer">
                                <slot name="footer">
                                    <!--<a href="" class="pull-left" @click.prevent="closeModal">Non merci</a>-->
                                    <a href="" class="pull-right" @click.prevent="submitThisCorporate">Partager et envoyer</a>
                                </slot>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>

</template>

<script>
    // import tagsInput from 'vue-tagsinput'; TODO delete this package
    import Multiselect from 'vue-multiselect';
    import Ckeditor from 'vue-ckeditor2';
    var qs = require('qs');

    export default {
        components: {
            'Multiselect' : Multiselect,
            'ckeditor': Ckeditor
        },
        props: {
            recipientManagerList: [],
            currentTemplate: [],
        },
        data() {
            return {
                areaList: '',
                areasearch: '',
                userKey : '',
                configMailer: {
                    language: 'fr',
                    removePlugins: 'elementspath',
                    height: 200,
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
                        top: 'mailer-content-toolbar'
                    },
                    toolbar: [
                        [ 'Bold', 'Italic', 'Underline','PostupAutomatisator']
                    ],
                },
                corporateFiltered: '',
                corporatesearch: '',
                corporatesToAdd: [],
                loading : false,
                loadingdata: false,
                mailsearch: '',
                mailsToSend: [],
                mailsTags: [],
                namesearch: '',
                options: [],
                page: '',
                recipientsList : '',
                regionList: '',
                regionsearch: '',
                sendable : true,
                searchError: null,
                showModal : false,
                userData: [],
                value: [],
                valueRecipientsManager : [],
                selectedEmailsNb: 0
            }
        },
        created() {
            var apiKey = document.getElementById('userKey').value;
            this.userKey = apiKey;

            axios.get('api/user?api_token='+this.userKey, {
            }).then((response) => {
                this.userData = response.data;
                })
                .catch((error) => {
                        console.log(error);
                });

        },
        watch: {

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

            mailsearch : function()
            {
                if(this.mailsearch != "")
                {
                    this.sendable = true;
                }else{
                    this.sendable = false;
                }
                if(this.mailsToSendlength > 0)
                {
                    this.sendable = true;
                }else{
                    this.sendable = false;
                }
            },
            value : function()
            {

                var modalState = false;
                var corporatesUnknown = [];
                $.each(this.value, function(key, value)
                {
                    console.log(value);
                    console.log(value.name);
                    if(value.confirmed == false)
                    {
                        //alert('ajouter a la databse');

                        var corporateSetter = {
                            name: '',
                            email: value.name,
                            canton: '',
                            area: '',
                            firstname: '',
                            lastname: '',
                            city: '',
                            adresse: '',
                            npa: '',
                            sexe: ''

                        };
                        //corporatesUnknown.push(value);
                        corporatesUnknown.push(corporateSetter);
                        modalState = true; // change state to showing modal
                    }

                });

                console.log('watched : ');
                console.log(corporatesUnknown);
                this.corporatesToAdd = corporatesUnknown;
                if(modalState == true){
                    this.showModal = true; // change global var for active modal
                }

                this.selectedEmailsNb = $(this.value).toArray().length + this.recipientManagerList.length;
            },
            recipientManagerList: function()
            {
                //alert('props changed');
                console.log(this.recipientManagerList.length);
                this.selectedEmailsNb = $(this.value).toArray().length + this.recipientManagerList.length;
                this.valueRecipientsManager = this.recipientManagerList;


            },
            currentTemplate: function(){
                //this.mailer = this.currentTemplate;
                this.$emit('input', this.currentTemplate);
            }
        },
        methods: {
            loadThisTemplate: function(id)
            {


                axios.get('api/template/'+id+'?api_token='+this.userKey)
                        .then((response) => {
                    console.log(response.data);
                    this.currentTemplate.letter.currentDate = moment().format('LL');
                    this.dataToTemplate(response.data);
                })
                    .catch((error) => {
                    console.log(error);
                    //this.showLoadTemplateError();
                });

            },
            dataToTemplate: function(data)
            {
                this.currentTemplate.id = data.id;
                this.currentTemplate.name = data.name;
                this.currentTemplate.oldName = data.name;
                this.currentTemplate.letter.object = data.object;
                this.currentTemplate.letter.content = data.content;
                this.currentTemplate.letter.salutation = data.salutation;
                this.currentTemplate.updated_at = moment(String(data.updated_at)).format('DD/MM/YYYY à hh:mm');
                this.currentTemplate.mailer.object = data.email_object;
                this.currentTemplate.mailer.content = data.email_content;
                this.templateName = data.name;
                this.templateNameOld = data.name;
                this.selectedTemplateId = data.id; // for template manager selected elements
            },
            goToMailer: function(){
                if($("#wrapper").attr('class') == "" || $("#wrapper").attr('class') === null)
                {
                    $("#wrapper").toggleClass("active"); // close the side navbar
                }
                $('#recipient-manger-col-wrapper').removeClass('col-lg-3');
                $('#recipient-manger-col-wrapper').addClass('col-lg-6');
                $('#mailer-col-wrapper').removeClass('col-lg-3');
                $('#mailer-col-wrapper').addClass('col-lg-6');
                $('#mailer-textarea').attr("rows", 13);
                this.$emit('input', 'mailer');
                this.page = 'mailer';
                //this.$route.router.go('/#/desk/template/mailer');
            },
            goToLetter: function(){
                $('#recipient-manger-col-wrapper').removeClass('col-lg-6');
                $('#recipient-manger-col-wrapper').addClass('col-lg-3');
                $('#mailer-col-wrapper').removeClass('col-lg-6');
                $('#mailer-col-wrapper').addClass('col-lg-3');
                $('#mailer-textarea').attr("rows", 5);
                this.$emit('input', 'letter');
                this.page = 'letter';
            },
            putTomailsToSend: function(contact)
            {


            },
            refreshMailSearch: function()
            {
                if(this.mailsearch.length > 2)
                {

                    axios.get('/api/search/recipient?q='+this.mailsearch, {

                        recipient: this.mailsearch

                    }).then((response) => {

                        //console.log(response.data);
                        var self = this;
                    this.recipientsList = response.data;

                })
                .catch((error) => {

                    console.log(error);
                    //TODO: add error msg

                });

                }
            },
            areaSearch: function()
            {
                if(this.areasearch.length > 2)
                {
                    axios.get('/api/search/area?area='+this.areasearch, {

                        area: this.areasearch

                    })
                            .then((response) => {

                        //console.log(response.data);
                        this.areaList = response.data;

                })
                .catch((error) => {

                    //console.log(error);
                    //TODO: add error msg

                });
                }
            },
            mailerSendToMe: function()
            {

                axios.post('/api/emailer/sendToMe?api_token='+this.userKey, {
                    template_slug : this.$route.params.slug,
                    mail_object: this.currentTemplate.mailer.object,
                    mail_content: this.currentTemplate.mailer.content
                })
                        .then((response) => {
                    //console.log(response.data);
                    // TODO add success message
                })
                .catch((error) => {
                console.log(error);
                //TODO: add error msg

            });
            },
            checkThisMailAdresse: function()
            {
                //console.log('nous ne connaissons pas cette adresse');
            },
            validateEmail: function(email)
            {
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            addTag (newTag)
            {

                if(this.validateEmail(newTag))
                {

                    const tag = {
                        name: newTag,
                        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000)),
                        confirmed: false
                    }
                    this.options.push(tag);
                    this.value.push(tag);

                } else {

                    console.log('email not valid');

                }


            },
            reloadCorporates (newTag)
            {
                if(newTag.length > 2)
                {
                    this.options = [];
                    axios.get('/api/search/recipient?q='+newTag+'&api_token='+this.userKey)
                            .then((response) => {
                        var allTags = [];
                    $.each(response.data,  function(key, value)
                    {

                            var tag = {
                                name :  value.email,
                                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000)),
                                confirmed: true
                            };

                            allTags.push(tag);



                    });
                    this.options = allTags;

                })
                .catch((error) => {

                    console.log(error);
                    //TODO: add error msg

                });
                }
            },
            checkUnknownMail: function(email){

            },
            regionSearch: function(region)
            {
                    if(region.length > 2)
                    {

                        axios.get('/api/search/region?region='+region+'&api_token='+this.userKey)
                                .then((response) => {
                            //console.log(response.data);
                            this.regionList = response.data;
                        })
                            .catch((error) => {
                            console.log(error);
                            //TODO: add error msg
                        });

                    }

            },
            areaSearch: function(search)
            {
                if (search.length > 2)
                {

                    axios.get('/api/search/area?area='+search+'&api_token='+this.userKey)
                            .then((response) => {
                                console.log(response.data);
                                this.areaList = response.data;

                            }).catch((error) => {

                                //console.log(error);
                                //TODO: add error msg

                            });

                }
            },
            sendThisMailer: function()
            {
                //console.log(this.value);
                if(this.value != [])
                {
                        axios.post('/api/emailer/sendToRecipe?api_token=' + this.userKey, qs.stringify({
                            slug: this.$route.params.slug,
                            recipients_list: JSON.stringify(this.value),
                            mail_object: this.currentTemplate.mailer.object,
                            mail_content: this.currentTemplate.mailer.content
                        })).then((response) => {
                            console.log(response.data);
                            this.userData.mails_reserve = this.userData.mails_reserve - this.value.length;
                        }).
                        catch((error) => {
                                console.log(error.response);
                        });
                }

                // send to recipients from recipients manager
                if(this.valueRecipientsManager != [])
                {

                    var recipientsValue = [];
                    $.each(this.valueRecipientsManager, function(index, value) {
                    //    console.log(value);
                        var recip = {
                          name : value.email
                        };
                        recipientsValue.push(recip);
                    });
                    console.log(recipientsValue);

                    axios.post('/api/emailer/sendToRecipe?api_token='+this.userKey, qs.stringify({
                        slug: this.$route.params.slug,
                        recipients_list: JSON.stringify(recipientsValue),
                        mail_object: this.currentTemplate.mailer.object,
                        mail_content: this.currentTemplate.mailer.content
                        })).then((response) => {
                            console.log(response.data);
                            console.log('*** recipients value *****');
                            console.log(recipientsValue);
                            this.userData.mails_reserve = (this.userData.mails_reserve - this.valueRecipientsManager.length);

                    }).catch((error) => {
                        console.log(error.response);
                    });
                }

            },
            checkField: function(data)
            {
                if(data.length < 3 || data == "" || data == undefined){
                    return 'has-warning';
                }else{
                    return '';
                }
            },
            closeModal: function()
            {
                this.showModal = false;
            },
            submitThisCorporate: function()
            {
                //corporatesToAdd
                $.each(this.corporatesToAdd, function(key, value)
                {
                    var userKey = document.getElementById('userKey').value; // needed
                    axios.post('/api/addManuallyCorporateByUser?api_token='+userKey, {
                                name: value.name,
                                contact_firstname:  value.firstname,
                                contact_lastname: value.lastname,
                                contact_sexe: value.sexe, // 0 for mens and 1 for womans
                                adresse: key.adresse,
                                npa: value.npa,
                                city: value.city,
                                canton: value.canton,
                                email: value.email,
                                area_id : value.area,
                                contact_sexe : value.sexe
                            })
                            .then((response) => {

                        console.log(response.data);

                    })
                    .catch((error) => {
                        console.log(error.response);
                    });
                });
                this.showModal = false;
            }
        }
    }
</script>

<style lang="css">
    #mailer-col-wrapper {
        float: right;
        -webkit-transition-property: width height right top;
        -webkit-transition-duration: 0.3s;
        -webkit-transition-timing-function: ease-out;
        transition-property: width height right top ;
        transition-duration: 0.3s;
        transition-timing-function: ease-out;
    }
    #mailer-col-wrapper panel{
        height: 100%;
    }
    #mailer-col-wrapper textarea{

    }.modal-mask {
         position: fixed;
         z-index: 9998;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, .5);
         display: table;
         transition: opacity .3s ease;
     }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .mailer-wrapper input{
        font-size: 12px;
    }

    .modal-container {
        width: 70%;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }
    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
    #cke_2_contents{
        /*position: absolute;*/
    }
</style>
