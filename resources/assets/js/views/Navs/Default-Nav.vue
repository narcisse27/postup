<template>
    <div id="slidebar-white" class="slidebar-nav">
        <nav id="navbar-white" class="navbar navbar-default" role="navigation">
            <div  class="collapse userDataFormCollapse">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="col-lg-2 col-lg-offset-2">
                            <label for="inputFileProfilPicture" class="btn btn-default">
                                <img src="http://lyonlibreweb.org/laruche/wordpress/wp-content/uploads/2015/03/photo.jpg" alt="" class="img img-responsive" draggable="false">
                            </label>
                            <input type="file" id="inputFileProfilPicture" style="display: none" />
                        </div>

                        <div class="col-lg-8">
                            {{ userData.firstname }} {{ userData.lastname }}
                            Communication
                            <br>
                            <a href="/logout">Me déconnecter</a>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <form class="form-horizontal">
                        <br>
                        <div class="form-group">
                            <label for="inputUserFirstname" class="col-lg-2 control-label">Prénom</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputUserFirstname" placeholder="Prénom" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserLastname" class="col-lg-2 control-label">Nom</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputUserLastname" placeholder="Nom" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserAdresse" class="col-lg-2 control-label">Adresse</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputUserAdresse" placeholder="Adresse" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserNpa" class="col-lg-2 control-label">NPA</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" id="inputUserNpa" placeholder="npa" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserCity" class="col-lg-2 control-label">Ville</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputUserCity" placeholder="Ville" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserCanton" class="col-lg-2 control-label">Canton</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputUserCanton" placeholder="Canton" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserTel" class="col-lg-2 control-label">Tél</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputUserTel" placeholder="07X 999 99 99" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserMail" class="col-lg-2 control-label">Mail</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputUserMail" placeholder="monadresse@gmail.com" >
                            </div>
                        </div>

                        <button class="pull-right btn" ><span class="ion-checkmark"></span></button>
                    </form>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!--
                        <p>
                            <a href="">Mes dernières postulations</a>
                            <br>
                            <a href="">Proposer des améliorations</a>
                            <br>
                            <a href="">Passer premium</a>
                        </p>
                        -->
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 sidebar-nav"><!-- // TODO maybe to delete -->
            </div>
                <div id="template-list-wrapper">

                    <div class="" id="template-list-wrapper-component">
                        <div class="col-lg-12">
                            <br>
                            <h4>Templates <a href="/#/">+</a></h4>
                        </div>
                        <div  v-for="template in templates" v-bind:key="template.id">
                            <div class="panel-group template-panel-item">
                                <div class="panel panel-default">
                                    <div v-if="template.id == selectedTemplate.id" class="panel-heading template-manager-list-head template-manager-selected-template">
                                        <div class="panel-title">
                                            <div class="template-manager-header">
                                                <div class="template-manager-temp-name" @click="loadThisTemplate(template.id)" title="afficher ce template">
                                                    {{ template.name}}
                                                </div>
                                                <div class="template-manager-temp-icons ion-btn" @click="duplicateThisTemplate(template.id)">
                                                    <span class="ion-ios-copy" title="copier ce template"></span>
                                                </div>
                                                <div class="template-manager-temp-icons ion-btn" data-toggle="collapse" v-bind:href="'#collapse_'+template.id">
                                                    <span class="ion-more" title="afficher les détails"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else class="panel-heading">
                                        <div class="panel-title">
                                            <div class="template-manager-header">
                                                <a :href="'/desk#/template/mix/' + template.slug ">
                                                    <div class="template-manager-temp-name"  title="afficher ce template">
                                                        {{ template.name}}
                                                    </div>
                                                </a>
                                                <div class="template-manager-temp-icons ion-btn" @click="duplicateThisTemplate(template.id)">
                                                    <span class="ion-ios-copy" title="copier ce template"></span>
                                                </div>
                                                <div class="template-manager-temp-icons ion-btn" data-toggle="collapse" v-bind:href="'#collapse_'+template.id">
                                                    <span class="ion-more" title="afficher les détails"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-bind:id="'collapse_'+template.id" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                <li v-for="appendice in template.appendices">{{ appendice.name }}</li>
                                            </ul>
                                            <hr>
                                            <div class="" @click="deleteTemplate(template.id)">
                                                <span class="ion-btn ion-trash-b pull-right" title="supprimer ce template"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="col-lg-12">
                <h4>Nos Modèles</h4>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <router-link to="/mail-filler" class="center-align">Remplire reserve de mails</router-link>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>
<style>
.template-panel-item{
    margin-bottom: 0px;
    background-color: #e8e6e7;
}
.template-panel-item:hover{
    color: #8269a4;
    background-color: #dadada;
    transition: 100ms;
}
</style>
<script>
    export default
    {
        props: ['currentTemplate', 'templates'],
        components: {

        },
        data() {
            return {
                userKey: '',
                selectedTemplateId: '',
                selectedTemplate: [],
                userData: []
            }
        },
        created(){
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
        computed: {
            checkoutName: function(){

            }
        },
        watch: {
            '$props': function(val, oldVal){
                //alert('value changed from : '+oldVal + ' to '+ val);
            },
            '$route': function(newRoute, oldRoute)
            {
                console.log(newRoute);
                console.log(oldRoute);
                if(oldRoute.query.menu != newRoute.query.menu){
                    $("#wrapper").toggleClass("toggled");
                }
            }


        },
        mounted() {
            console.log('Component mounted.');
            this.selectedTemplate = this.currentTemplate;
        },
        methods:
        {
            refreshTemplateManager: function ()
            {
                axios.get('api/template?api_token='+this.userKey, {
                })
                        .then((response) => {
                    this.myTemplates = response.data[0];
                this.$emit('input', this.myTemplates);
            })
                .catch((error) => {
                //console.log(error);
                //this.ShowRefreshTemplatesError();
            });
            },
            dataToTemplate: function(data)
            {
                this.currentTemplate.id = data.id;
                this.currentTemplate.name = data.name;
                this.currentTemplate.oldName = data.name;
                this.currentTemplate.factory = data.factory;
                this.currentTemplate.letter.object = data.object;
                this.currentTemplate.letter.content = data.content;
                this.templateName = data.name;
                this.templateNameOld = data.name;
                this.selectedTemplateId = data.id; // for template manager selected elements
            },
            loadThisTemplate: function(id)
            {
                // '+id+'
                axios.get('api/template/'+id+'/?api_token='+this.userKey, {
                })
                        .then((response) => {
                    console.log(response.data);
                this.currentTemplate.letter.currentDate = moment().format('LL');
                this.dataToTemplate(response.data);
                var editor = tinymce.get('letter-personal-content');
                editor.setContent( this.currentTemplate.letter.content ); // change dinamicly tiny content
                //this.refreshAppendice();
                this.$emit('input', this.currentTemplate);

            })
                .catch((error) => {
                //console.log(error);
                //this.showLoadTemplateError();
                //TODO ADD erro
            });

            },
            deleteTemplate: function(id)
            {
                axios.delete('/api/template/'+id+'/?api_token='+this.userKey, {
                    id : id,
                })
                        .then((response) => {
                    //console.log(response.data);

                    this.refreshTemplateManager(); // refresh all data in template manager
                var firstTemplateId = this.myTemplates[0].id;
                if(firstTemplateId){
                    this.loadThisTemplate(this.myTemplates[0].id);
                }else{
                    this.loadThisTemplate(1); // if any template in store, load empty template
                }
                this.refreshTemplateManager();
                this.$emit('input', this.myTemplates);
                this.showTemplateDeleteSuccess();

            })
                .catch((error) => {
                //console.log(error);
                //TODO: add error msg

            });
            },
            duplicateThisTemplate: function(id)
            {
                axios.post('/api/template/duplicate?api_token='+this.userKey, {
                    id : id
                })
                        .then((response) => {
                    this.refreshTemplateManager(); // refresh all data in template manager
                //this.showTemplateDuplicateSuccess(); // show success msg
                // TODO add notification
            })
                .catch((error) => {
                //console.log(error);
                //this.showTemplateDuplicateError();
                // TODO add notification
            });

            },

        }

    }

</script>
