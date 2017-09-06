<template lang="html">
    <div class="">
        <div class="col-lg-12 card">
            <div class="panel panel-default">
                <div class="panel-heading heading-custom text-center">
                    <div class="col-lg-1">
                        <img :src="'storage/' + userData.picture_name" alt="user profil picture" draggable="false" class="img img-responsive img-avatar">
                    </div>
                    <div class="col-lg-9">
                        Carnet de postulation

                        <span  class="empty-template ion-close-round pull-right" @click="emptyTemplate"></span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-5">
                        <div id="hostory-content-scroll">
                            <div class="col-lg-12">
                                <div class="template-btn col-lg-12" v-for="item in history" @click="loadTemplate(item)" id="item.id">
                                    <div class="col-lg-4">
                                        {{ item.template.name }}
                                    </div>
                                    <div class="col-lg-4">
                                        {{ item.corporate.name }}
                                    </div>
                                    <div class="col-lg-4">
                                        {{ item.created_at }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="container" v-if="selectedTemplate != ''">
                            <div class="col-lg-6" >
                                <div id="sheet">
                                    <div class="col-lg-4">
                                        <p>
                                            {{ userData.firstname }} {{ userData.lastname }} <br>
                                            {{ userData.adresse }} <br>
                                            {{ userData.npa }} {{ userData.canton }}<br>
                                            {{ userData.phone }} <br>
                                            {{ userData.email }}
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-lg-offset-4">
                                        <p>
                                            {{ selectedTemplate.corporate.contact_firstname }} {{ selectedTemplate.corporate.contact_lastname }}
                                            <br>
                                            {{ selectedTemplate.corporate.adresse }} <br>
                                            {{ selectedTemplate.corporate.npa }} {{ selectedTemplate.corporate.canton }}
                                            <br>
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <br>
                                        <p>
                                            <strong>{{ selectedTemplate.template.object }}</strong> <br>
                                            <div v-html="selectedTemplate.template.content"></div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="corporate" >
                                    <strong>{{ selectedTemplate.corporate.name }}</strong> <br>
                                    {{ selectedTemplate.corporate.adresse }}
                                    {{ selectedTemplate.corporate.npa }}
                                    {{ selectedTemplate.corporate.city }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <router-link to="/" class="btn">Bureau</router-link>

    </div>
</template>

<script>
export default {
    data() {
        return {
            userData: [],
            userId: '',
            userKey: '',
            history: '',
            selectedTemplate: ''

        }
    },
    created(){
        this.userKey = document.getElementById('userKey').value;
        axios.get('/api/user?api_token='+this.userKey).then( (response) => {
            this.userId = response.data.id;
            this.userData = response.data;
        });

        axios.get('/api/mailsended?api_token='+this.userKey).then( (response) => {
            console.log(response.data);
            this.history = response.data;
        });
        this.selectedTemplate = '';
    },
    methods: {
        loadTemplate: function(item)
        {
            this.selectedTemplate = item;
        },
        emptyTemplate: function(){
            this.selectedTemplate = '';
        }
    }
}
</script>

<style lang="css">

    #hostory-content-scroll{
        height: 80vh;
        overflow-y: scroll;
    }
    #hostory-content-scroll::-webkit-scrollbar {
        width: 12px;
    }

    #hostory-content-scroll::-webkit-scrollbar-track {
        background-color: white;
        border-radius: 10px;
    }

    #hostory-content-scroll::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: rgb(118,43,238);
    }

    .template-btn{
        width: 100%;
        height: auto;
        background-color: white;
        color: #303030;
        transition: 100ms;
        border-bottom: 1px solid gainsboro;
    }
    .template-btn:hover{
        width: 100%;
        height: auto;
        background-color: #7e1ef3;
        color: white;
        transition: 100ms;
        cursor: pointer;
    }

    .img-avatar {
        width: 40px;
        height: 40px;
        margin-top: 10px;
        border-radius: 50%;
        border: 1px solid #f64a8a;

    }

    #panel-data{
        height: 100%;
        width: 100%;
    }
    #sheet{
        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
    }
    .empty-template:hover{
        cursor: pointer;
        color: #7e1ef3;
        transition: 100ms;
    }
</style>
