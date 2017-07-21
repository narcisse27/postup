<template>
    <div id="desk-wrapper">
        <div id="slidebar-gradiant" class="col-lg-3">
            <nav  class="navbar navbar-default" role="navigation">
                <div  class="collapse userDataFormCollapse">
                    <div class="row">
                        <div class="col-lg-12">

                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12 " id="letter-wrapper">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <h2>Bienvenu Thomas !</h2>
                        </div>
                        <div class="col-lg-4" v-for="factemplate in factoryTemplates">
                            <a v-bind:href="'/desk#/template/usine/' + factemplate.slug" v-bind:title="factemplate.name" class="" id="new-template-link">
                                <div class="template-icon">
                                    <img src="assets/app/img/template-new-desk.jpg" alt="">
                                </div>
                            </a>
                            <p>{{ factemplate.name }}</p>
                        </div>

                        <div v-if="templates" class="col-lg-2" v-for="template in templates">
                            <a v-bind:href="'/desk#/template/mix/' + template.slug" v-bind:title="template.name">
                                <div class="template-icon">
                                    <img src="assets/app/img/template-picto-desk.jpg" alt="">
                                </div>
                            </a>
                            <p>{{ template.name }}</p>
                        </div>
                        <div v-elseif>
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
        </div>
    </div>

</template>
<style>
    #desk-wrapper{
        width: 100vw;
        height: 100vh;
        background-color: #e8e6e7;
    }

    #slidebar-gradiant{
        top: 0!important;
        left: 0;
        width: 20%;
        height: 100%;
        background: url('/assets/app/img/navbar-desk-background-gradiant.png');
    }

    .empty-tempalte-icon{
        margin-top: 50px;
        height: 120px;
    }
    .template-icon{
        margin-top: 50px;
        height: 90%;
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

    #new-template-link{

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
