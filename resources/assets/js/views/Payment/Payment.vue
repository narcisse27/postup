<template lang="html">
        <div class="modal-wrapper">
            <div class="modal-container">

                <div class="modal-header">
                    <slot name="header">
                        <h2>Rechargez votre réserve d'emails</h2>
                    </slot>
                </div>

                <div class="modal-body">
                    <slot name="body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>Pack petit malin</h3>
                                <form class="form-control">
                                    <div class="group">
                                        <label>
                                            <span>Name</span>
                                            <input name="cardholder-name" class="field" placeholder="Jane Doe" />
                                        </label>
                                        <label>
                                            <span>Tél</span>
                                            <input class="field" placeholder="(123) 456-7890" type="tel" />
                                        </label>
                                    </div>
                                    <div class="group">
                                        <label>
                                            <span>Carte</span>
                                            <div id="card-element" class="field"></div>
                                        </label>
                                    </div>
                                    <button type="submit" style="background-image: url('../assets/landing/img/btn-gradiant-tmplate-manager.jpg'); border-radius: 20px; border: 0px;color:white;">50 emails / 4.90.-</button>
                                    <div class="outcome">
                                        <div class="error" role="alert"></div>
                                        <div class="success">
                                            Success! Your Stripe token is <span class="token"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <h3>Pack Hacker</h3>
                                <form class="form-control">
                                    <div class="group">
                                        <label>
                                            <span>Name</span>
                                            <input name="cardholder-name" class="field" placeholder="Jane Doe" />
                                        </label>
                                        <label>
                                            <span>Tél</span>
                                            <input class="field" placeholder="(123) 456-7890" type="tel" />
                                        </label>
                                    </div>
                                    <div class="group">
                                        <label>
                                            <span>Carte</span>
                                            <div id="card-element" class="field"></div>
                                        </label>
                                    </div>
                                    <button type="submit" style="background-image: url('../assets/landing/img/btn-gradiant-tmplate-manager.jpg'); border-radius: 20px; border: 0px;color:white;">100 emails / 8.90.-</button>
                                    <div class="outcome">
                                        <div class="error" role="alert"></div>
                                        <div class="success">
                                            Success! Your Stripe token is <span class="token"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </slot>
                </div>
                <div class="modal-footer">
                    <slot name="footer">
                        <button @click="closeImporvementModal">X</button>
                        <!--
                        <button class="modal-default-button" style="background-image: url('../assets/landing/img/btn-gradiant-tmplate-manager.jpg'); border-radius: 20px; border: 0px;color:white;">
                            Envoyer
                        </button>
                        -->
                    </slot>
                </div>
            </div>
        </div>
</template>

<script>
export default {
}
</script>

<style lang="css">


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
</style>
