<template>
    <div class=" " id="user-mini-manager">
        <div class="row">

            <div class="" id="side-bar-toggler">
                <span class="ion-navicon-round align-middle" @click="toggleNavbar" ></span>
            </div>
            <div class="nav-avatar-wrapper">
                <div id="avatar-wrap" class=" no-padding-left no-padding-right">
                    <img  class="align-middle img-avatar" :src="'storage/' + userData.picture_name" alt="user profil picture" draggable="false">
                </div>
                <div id="avatar-data" class="">
                    <p>
                        <strong>{{ userData.firstname |uppercase}} {{ userData.lastname |uppercase}} </strong>
                        Communication
                    </p>
                </div>
                <div class="col-lg-1" id="toggler-userDataForm" >
                    <h4>
                        <a data-toggle="collapse" href=".userDataFormCollapse">
                            <span id="toggler-userDataForm-ion" class="ion-ios-arrow-down ion-btn"  ></span>
                        </a>
                    </h4>
                </div>
            </div>

        </div>
        <div id="userDataFormCollapse" class="collapse userDataFormCollapse">
            <div class="row">
                <div class="col-lg-12">

                    <div class="col-lg-2 col-lg-offset-2">
                        <label for="inputFileProfilPicture" class="btn btn-default">
                            <img src="http://lyonlibreweb.org/laruche/wordpress/wp-content/uploads/2015/03/photo.jpg" alt="" class="img img-responsive" draggable="false">
                        </label>
                        <input type="file" id="inputFileProfilPicture" style="display: none" @change="updateUserPicture"/>
                    </div>

                    <div class="">
                        {{ userData.firstname }} {{ userData.lastname }}
                        Communication
                        <br>
                        <a href="/logout">Me déconnecter</a>
                    </div>

                </div>
            </div>
            <div class="row">
                <form class="form-horizontal col-lg-12">

                    <div class="form-group">
                        <label for="inputUserFirstname" class="col-lg-2 control-label">Prénom</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputUserFirstname" placeholder="Prénom" v-model="userData.firstname">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserLastname" class="col-lg-2 control-label">Nom</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputUserLastname" placeholder="Nom" v-model="userData.lastname">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserAdresse" class="col-lg-2 control-label">Adresse</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputUserAdresse" placeholder="Adresse" v-model="userData.adresse">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserNpa" class="col-lg-2 control-label">NPA</label>
                        <div class="col-lg-10">
                            <input type="number" class="form-control" id="inputUserNpa" placeholder="npa" v-model="userData.npa">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserCity" class="col-lg-2 control-label">Ville</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputUserCity" placeholder="Ville" v-model="userData.city">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserCanton" class="col-lg-2 control-label">Canton</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputUserCanton" placeholder="Canton" v-model="userData.canton">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserTel" class="col-lg-2 control-label">Tél</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputUserTel" placeholder="07X 999 99 99" v-model="userData.phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserMail" class="col-lg-2 control-label">Mail</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputUserMail" placeholder="monadresse@gmail.com" v-model="userData.email">
                        </div>
                    </div>

                    <button class="pull-right btn" @click="updateUserData"><span class="ion-checkmark"></span></button>
                </form>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        <router-link to="/history">Mes dernières postulations</router-link>
                        <br>
                        <a @click.prevent="openImporvementModal">Proposer des améliorations</a>
                        <br>
                        <a @click.prevent="openPaymentModal">Passer premium</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-mask" v-if="showImporvementModal">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            <h2>Proposition d'amélioration</h2>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <form action="" class="form-control">
                                <div class="form-group">
                                    <label for="">Objet</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Proposition</label>
                                    <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </form>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button @click="closeImporvementModal">X</button>
                            <button class="modal-default-button" style="background-image: url('../assets/landing/img/btn-gradiant-tmplate-manager.jpg'); border-radius: 20px; border: 0px;color:white;">
                                Envoyer
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-mask" v-if="showPaymentModal">
            <Payment></Payment>
        </div>
    </div>
</template>
<script>
    import Payment from '../Payment/Payment';
    export default {
        components: {
            'Payment' : Payment
        },
        data () {
            return {
                showImporvementModal: false,
                showPaymentModal: false,
                userKey: '',
                userData: []
            }
        },
        created(){
            var apiKey = document.getElementById('userKey').value;
            this.userKey = apiKey;

            axios.get('api/user?api_token='+this.userKey, {
            })
                    .then((response) => {
                //console.log(response.data);
                this.userData = response.data;
            // TODO add success message
            this.$emit('input', this.userData);
        })
        .catch((error) => {
                console.log(error);
            // TODO add error message
        });

        },
        methods: {
            updateUserData: function(){
                axios.patch('api/user/update?api_token='+this.userKey, {
                    id: this.userData.id,
                    firstname : this.userData.firstname,
                    lastname : this.userData.lastname,
                    npa : this.userData.npa,
                    city : this.userData.city,
                    canton : this.userData.canton,
                    phone : this.userData.phone,
                    adresse : this.userData.adresse,
                    canton: this.userData.canton,

                }).then((response) => {
                    this.userData = response.data;
            })
                .catch((error) => {
                    console.log(error);
            });
            },
            updateUserPicture: function(e){
                console.log(e.target.files[0].name);
                var fileName = e.target.files[0].name;
                var type = e.target.files[0].type;
                var fileReader = new FileReader();
                console.log(type);
                fileReader.readAsDataURL(e.target.files[0]);
                if(type == 'image/jpeg' || type == 'image/jpg' || type == 'image/png'){

                    fileReader.onload = (e) => {
                        axios.post('/api/user/updatepicture?api_token='+this.userKey, {
                            file : e.target.result,
                            extension: type,
                            name: fileName,
                        })
                                .then((response) => {
                            $('#appendiceInputFile').val(""); //  empty input value TODO
                        this.userData.picture_name = response.data.picture;

                    })
                    .catch((error) => {
                            //console.log(error.response.data.message);
                        });
                    }
                }else{
                    // TODO show error message for format type
                }
            },
            openNavbar : function()
            {
                this.$router.push({ query: { menu: 'open'}})
            },
            closeNavbar : function()
            {

            },
            toggleNavbar: function()
            {

                if( this.$route.query.menu == 'open' )
                {
                    this.$router.push({query: {menu: 'close'}});

                }else{

                    this.$router.push({ query: { menu: 'open'}});

                }

            },
            openImporvementModal: function()
            {
                this.showImporvementModal = true;
            },
            closeImporvementModal: function()
            {
                this.showImporvementModal = false;
            },
            openPaymentModal: function()
            {
                this.showPaymentModal = true;
            }

        }
    }
</script>
<style>
    #nav-avatar-wrapper{
        float: left;
        width: 80%;
        height: 100%;
    }
    #user-mini-manager{
        height: 67px;
        width: 250px;
        background-color: #e8e6e7;
        font-size: 11px;

    }
    #avatar-wrap{
        float: left;
        width: 20%;
    }
    #avatar-data{
        float: left;
        width: 40%;
        height: 100%;
    }

    #avatar-data p{
        vertical-align: middle;
        margin-top: 10px;
    }


    #user-mini-manager input{
        font-size: 11px;

    }
    #side-bar-toggler{
        height: 100%;
        width: 20%;
        float: left;
        margin-top: 10px;
    }

    #side-bar-toggler:hover{
        cursor: pointer;
    }

    #side-bar-toggler span{
        font-size: 20px;
        margin: auto;
        margin-left: 25px;
    }

    .img-avatar {
        width: 40px;
        height: 40px;
        margin-top: 10px;
        border-radius: 50%;
        border: 1px solid #f64a8a;

    }
    #userDataFormCollapse{
        width: 100%;
        padding-left: 10%;
        padding-right: 10%;
        padding-top: 40px;
        background-color:  #e8e6e7 ;
    }
    #userDataFormCollapse .row{
        background-color: #e8e6e7;

    }
</style>