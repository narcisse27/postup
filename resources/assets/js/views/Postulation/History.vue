<template lang="html">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 card">
                <div class="panel panel-default">
                    <div class="panel-heading heading-custom">
                        <div class="col-lg-12">
                            <div class="col-lg-2">
                                <img :src="'storage/' + userData.picture_name" alt="user profil picture" draggable="false" class="img img-responsive img-avatar">
                            </div>
                                {{ userData.firstname }} {{ userData.lastname}}
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <span>Historique de vos postulations</span>
                        </div>
                        <div class="col-lg-12">
                            <a href="/desk">Bureau</a>
                        </div>
                        <div id="hostory-content-scroll">
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <h5>Modèle</h5>
                                </div>
                                <div class="col-lg-4">
                                    <h5>Destinataire</h5>
                                </div>
                                <div class="col-lg-4">
                                    <h5>Date d'envoi</h5>
                                </div>
                            </div>

                            <div class="col-lg-12 list-item" v-for="item in history">
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
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            userData: [],
            userId: '',
            userKey: '',
            history: ''

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
    }
}
</script>

<style lang="css">
    .img-avatar {
        width: 40px;
        height: 40px;
        margin-top: 10px;
        border-radius: 50%;
        border: 1px solid #f64a8a;

    }
    .list-item{
        border-bottom: 1px solid gainsboro;
    }
</style>
