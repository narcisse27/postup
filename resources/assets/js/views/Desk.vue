<template>
        <div class="row">
            <div class="col-lg-12 card" id="letter-wrapper">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Choisissez un modèle</h1>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <h2>Nos templates</h2>
                            <div class="col-lg-1" v-for="factemplate in factoryTemplates">
                                <a v-bind:href="'/desk#/template/usine/' + factemplate.slug" v-bind:title="factemplate.name">
                                    <div class="template-icon">
                                        <img src="img/temp.png" alt="">
                                    </div>
                                </a>
                                <p>{{ factemplate.name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <h2>Vos modèles</h2>
                            <div v-if="templates" class="col-lg-1" v-for="template in templates">
                                <a v-bind:href="'/desk#/template/mix/' + template.slug" v-bind:title="template.name">
                                    <div class="template-icon">
                                        <img src="img/temp.png" alt="">
                                    </div>
                                </a>
                                <p>{{ template.name }}</p>
                            </div>
                            <div v-elseif>
                                <h2>Vous n'avez aucun modèle</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="showModal">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-container">

                                    <div class="modal-header">
                                        <slot name="header">
                                            <h4>
                                                Afin de générer vos lettres de postulations, veuillez entrez les informations suivantes
                                            </h4>
                                        </slot>
                                    </div>

                                    <div class="modal-body">
                                        <slot name="body">
                                            <form action="" class="form-horizontal col-lg-12">
                                                <div class="form-group" v-bind:class="checkField(adresseSubmit.adresse)">
                                                    <label for="inputAdresse" class="col-lg-2 control-label">Adresse*</label>
                                                    <div class="col-lg-10">
                                                        <input type="text" class="form-control" id="inputAdresse" placeholder="Adresse" v-model="adresseSubmit.adresse">
                                                    </div>
                                                </div>
                                                <div class="form-group"  v-bind:class="checkField(adresseSubmit.npa)">
                                                    <label for="inputAdresse" class="col-lg-2 control-label">npa*</label>
                                                    <div class="col-lg-10">
                                                        <input type="number" class="form-control" id="inputAdresse" placeholder="npa" v-model="adresseSubmit.npa">
                                                    </div>
                                                </div>
                                                <div class="form-group"  v-bind:class="checkField(adresseSubmit.city)">
                                                    <label for="inputCity" class="col-lg-2 control-label">Ville*</label>
                                                    <div class="col-lg-10">
                                                        <input type="text" class="form-control" id="inputCity" placeholder="Ville" v-model="adresseSubmit.city">
                                                    </div>
                                                </div>
                                                <div class="form-group"  v-bind:class="checkField(adresseSubmit.phone)">
                                                    <label for="inputPhone" class="col-lg-2 control-label">Téléphone</label>
                                                    <div class="col-lg-10">
                                                        <input type="text" class="form-control" id="inputPhone" placeholder="07X 100 10 10" v-model="adresseSubmit.phone"  v-mask="'999 999 99 99'">
                                                    </div>
                                                </div>
                                            </form>
                                        </slot>
                                    </div>

                                    <div class="modal-footer">
                                        <slot name="footer">
                                            <button class="modal-default-button"  @click="updateAdresse">
                                                <span class="ion-checkmark-round"></span>
                                            </button>
                                        </slot>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
</template>
<style>
    .empty-tempalte-icon{
        margin-top: 50px;
        height: 120px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        -moz-box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        -webkit-box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
    }
    .template-icon{
        margin-top: 50px;
        height: 120px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        -moz-box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        -webkit-box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
    }
    .template-icon img{
        width: 100%;
        height: auto;
    }

    .modal-mask {
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

    .modal-container {
        width: 600px;
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

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

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

</style>
<script>
    import DeskAdresse from './Modals/Desk-Adresse';
    import AwesomeMask from 'awesome-mask';
    export default {
        components: {
            'Desk-Adresse': DeskAdresse
        },
        data() {
          return {
              userKey: '',
              factoryTemplates: [],
              templates : [],
              showAdresseModal : false,
              showModal: false,
              adresseSubmit: {
                  adresse: '',
                  npa: '',
                  city: '',
                  phone: ''
              },
              adresseFormSendable: false
          }
        },
        directives: {
            'mask': AwesomeMask
        },
        created(){

            var apiKey = document.getElementById('userKey').value;
            this.userKey = apiKey;

            this.getFactoryTemplates();
            this.getTemplates();



        },
        mounted() {
            console.log('Component mounted.');
            // get user data
            axios.get('/api/user?api_token='+this.userKey)
                    .then( (response) => {
                console.log('user data');
                console.log(response.data);
                if( response.data.adresse == null || response.data.npa == null || response.data.city == null || response.data.phone == null)
                {
                    //$('#userAdresseModal').modal('show');
                    console.log('modal showed');
                    this.showModal = true;
                }
            });
        },
        computed(){
        },
        watch: {
            adresseForm : function(){
                if(this.adresseSubmit.adresse < 3 || this.adresseSubmit.npa < 3 || this.adresseSubmit.city < 3 || this.adresseSubmit.phone < 3){
                    this.adresseFormSendable = false;
                }else{

                    this.adresseFormSendable = true;
                }
            }
        },
        methods:{
            getFactoryTemplates: function(){
                        axios.get('/api/factorytemplate?api_token='+this.userKey, {

                        })
                        .then((response) => {

                            console.log(response.data);
                            var self = this;
                            this.factoryTemplates = response.data;

                        })
                        .catch((error) => {

                            console.log(error);
                            //TODO: add error msg
                        });
            },
            getTemplates: function(){
                        axios.get('/api/template?api_token='+this.userKey, {

                        })
                        .then((response) => {

                            console.log(response.data);
                            var self = this;
                            this.templates = response.data[0];

                        })
                        .catch((error) => {

                            console.log(error);
                            //TODO: add error msg
                        });
            },
            updateAdresse : function()
            {
                if(this.adresseSubmit.adresse.length > 3 && this.adresseSubmit.npa.length && this.adresseSubmit.city.length && this.adresseSubmit.phone.length)
                {

                    axios.post('/api/user/update/adresse?api_token='+this.userKey, {
                        adresse : this.adresseSubmit.adresse,
                        city: this.adresseSubmit.city,
                        npa : this.adresseSubmit.npa,
                        phone: this.adresseSubmit.phone
                    }).then((response) => {
                            this.showModal = false;
                            this.showAdresseUpdateSuccess();
                    })
                        .catch((error) => {
                            console.log(error.response.data.message);
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
        },
        notifications: {
            showAdresseUpdateSuccess: {
                title: 'Succès',
                message: 'Vis informations ont bien été mises à jour',
                type: 'success'
            }
        }
    }
</script>
