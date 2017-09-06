<template lang="html">
    <div id="payment-wrapper">
        <img id="payment-gradient-background" src="assets/app/img/payment-gradiant.jpeg" alt="">
        <div class="col-lg-12">
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <a href="/desk#">
                    <span class="ion-ios-arrow-back"></span> retour
                </a>
                <div class="container">
                    <div class="collapse navbar-collapse" id="">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Rechargez compte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Dernières postultaions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-lg-12">
            <div class="container color-white">
                <h3>Rechargez votre réserve de mails</h3>
                <p>
                    Vous avez besoin d'un plus grand réservoir d'envoi de mails ? <br>
                    Augmentez la capacité de votre compte dès maintenant selon vos besoins !
                </p>
                <div class="payment-packages-wrapper">
                    <div class="package-wrap col-lg-4 no-padding-left no-padding-right" style="border-radius: 5px;">
                        <div class="package-proposition" id="proposition-1">
                            <div class="col-lg-12">
                                <span class="package-reserve"><strong>50</strong></span></h3>
                                <span class="package-text">mails</span>
                            </div>
                        </div>
                        <div id="package-payment-1" style="display:none;">
                            <p>Rechargez votre réserve de 50 mails</p>
                            <card class='stripe-card'
                                  ref='50mails'
                                  :class='{ complete }'
                                  stripe='pk_test_j0Omcm9TfQ8HegvDC5xkOr4M'
                                  :options='stripeOptions'
                                  @change='complete = $event.complete'
                            />
                            <div class="package-btn"  @click='pay(1)'>
                                <div class="col-lg-12">
                                <span class="package-price">
                                    <strong>Valider</strong>
                                </span>
                                    <span class="ion-checkmark-round">
                                </span>
                                </div>
                            </div>
                            <!--<button class='pay-with-stripe' :disabled='!complete'>Valider</button>-->
                        </div>
                        <div class="package-btn" @click="selectPackage(1)" id="package-btn-1">
                            <div class="col-lg-12">
                                <span class="package-price">
                                    <strong>2.55</strong> CHF
                                </span>
                                <span class="ion-ios-arrow-thin-right">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="package-wrap col-lg-4 no-padding-left no-padding-right" style="border-radius: 5px;">
                        <div class="package-proposition" id="proposition-2">
                            <div class="col-lg-12">
                                <span class="package-reserve"><strong>100</strong></span></h3>
                                <span class="package-text">mails</span>
                            </div>
                        </div>
                        <div class="package-btn" @click="selectPackage(2)">
                            <div class="col-lg-12">
                                <span class="package-price">
                                    <strong>4.95</strong> CHF
                                </span>
                                <span class="ion-ios-arrow-thin-right">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="package-wrap col-lg-4 no-padding-left no-padding-right" style="border-radius: 5px; border-right: none!important;">
                        <div class="package-proposition" id="proposition-3">
                            <div class="col-lg-12">
                                <span class="package-reserve"><strong>300</strong></span></h3>
                                <span class="package-text">mails</span>
                            </div>
                        </div>
                        <div class="package-btn" @click="selectPackage(3)">
                            <div class="col-lg-12">
                                <span class="package-price">
                                    <strong>9.85</strong> CHF
                                </span>
                                <span class="ion-ios-arrow-thin-right"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="payment-second-text">
                    <div class="col-lg-12">
                        <p>
                        Postup vous permets dès la création de votre compte, de profiter de 8 envois gratuits par semaine. A chaque fin de moi votre réserve de mails se réinitialise à zéro. SI cette capacité ne convient pas à votre rithme de postulation vous pouvez profiter de nos packs pour adapter au mieux votre compte à vos besoins.
                        </p>
                     </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { Card, createToken } from 'vue-stripe-elements';
var $ = require('jquery');
export default {
    components: {
      Card
    },
    data() {
      return{
          complete: false,
          stripeOptions: {
              // see https://stripe.com/docs/stripe.js#element-options for details
          },
          selectedPackage: '',
          stripe_instance: {},
          userKey: '',
      }
    },
    created() {
        this.userKey = document.getElementById('userKey').value;
    },
    mounted()
    {

    },
    methods: {
        selectPackage: function(packageId)
        {
                this.selectedPackage = packageId;
                //alert(this.selectedPackage);

                $("#package-payment-"+packageId).attr('style', '');
                $("#proposition-"+packageId).attr('style', 'display:none;');
                $('#package-btn-'+packageId).attr('style', 'display:none');

        },
        pay (packageId) {

            createToken().then(data => this.stripe_instance = data.token);
            if(packageId == 1)
            {
                var charge = {
                    key: 'pk_test_j0Omcm9TfQ8HegvDC5xkOr4M',
                    name : "Pack 50 emails",
                    description : "Recharge de la réserve d'email de 50 unités",
                    amount: 255
                }

            }
            if(packageId == 2)
            {
                var charge = {
                    key: 'pk_test_j0Omcm9TfQ8HegvDC5xkOr4M',
                    name : "Pack 100 emails",
                    description : "Recharge de la réserve d'email de 50 unités",
                    amount: 495
                }

            }
            if(packageId == 3)
            {
                var charge = {
                    key: 'pk_test_j0Omcm9TfQ8HegvDC5xkOr4M',
                    name : "Pack 300 emails",
                    description : "Recharge de la réserve d'email de 50 unités",
                    amount: 985
                }

            }


            //createToken().then(data => console.log(data.token));
            //console.log('**** instance ****');
            //console.log(this.stripe_instance);


            axios.post('/api/payment?api_token='+this.userKey, {
                token: this.stripe_instance,
                chargeId: packageId,
                charge : charge

            })
            .then((response) => {
                console.log(response.data);
                alert("Payement validé");
            });

        }
    }
}
</script>

<style lang="css">
    #app{
        background-color: #ececec;
    }

    li a{
        margin-right: 50px;
        text-decoration: none;
        color: white;
    }

    #payment-wrapper{
        background-color: #ececec;
        color: white!important;
    }
    .payment-packages-wrapper{
        border-radius: 50px;
        background-color: white;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        height: 300px;
        width: 100%;
    }
    #payment-gradient-background{
        width: 100vw;
        height: 50vh;
        position: absolute;
        z-index: -1;
    }

    .color-white{
        color: white!important;
    }
    .color-white h3{
        color: white!important;
    }
    .package-wrap{
        background-color: white;
        height: 300px;
        border-right: 1px solid #ececec;
        color: #6600cc;
        border-radius: 5px;
    }
    .package-proposition{
        height: 75%;
        width: 100%;
        float: left;
    }
    .package-btn{
        width: 100%;
        height: 25%;
        float: left;
        background-color: white;
        color: #6600cc;
        transition: 100ms;
        font-size: 48px;
        /*font-weight: 300;*/
    }
    .package-btn:hover{
        background-color: #6600cc;
        color: white;
        transition: 100ms;
        cursor: pointer;
    }
    .ion-ios-arrow-thin-right{
        float: right;
        padding-right: 10px;
    }
    .package-reserve{
        width: 100%;
        font-size: 100px;
        margin-right: 50%;
        line-height: 1.3;
        padding-top: 50%;
    }
    .package-text{
        font-size: 48px;
    }
    .payment-second-text{
        color: #b6b6b6;
    }
    .payment-second-text p{
        margin-top: 350px;
    }

    .group {
        background: white;
        box-shadow: 0 7px 14px 0 rgba(49,49,93,0.10),
        0 3px 6px 0 rgba(0,0,0,0.08);
        border-radius: 4px;
        margin-bottom: 20px;
    }






    .field {
        background: transparent;
        font-weight: 300;
        border: 0;
        color: #31325F;
        outline: none;
        padding-right: 10px;
        padding-left: 10px;
        cursor: text;
        width: 70%;
        height: 40px;
        float: right;
    }

    .field::-webkit-input-placeholder { color: #CFD7E0; }
    .field::-moz-placeholder { color: #CFD7E0; }
    .field:-ms-input-placeholder { color: #CFD7E0; }


    .outcome {
        float: left;
        width: 100%;
        padding-top: 8px;
        min-height: 24px;
        text-align: center;
    }

    .success, .error {
        display: none;
        font-size: 13px;
    }

    .success.visible, .error.visible {
        display: inline;
    }

    .error {
        color: #E4584C;
    }

    .success {
        color: #666EE8;
    }

    .success .token {
        font-weight: 500;
        font-size: 13px;
    }
    .stripe-card {
        width: 300px;
        border: 1px solid grey;
    }
    .stripe-card.complete {
        border-color: green;
    }
</style>
