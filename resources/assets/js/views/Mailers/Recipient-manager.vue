<template lang="html">
    <div class="col-lg-6 card appear-anim no-padding-left no-padding-right">
        <div class="panel panel-default card appear-anim">
            <div class="panel-heading">Recherches</div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Regions</label>
                                    <input list="regions" name="region_filter" id="" class="form-control" type="text" v-model="regionsearch" v-on:keyup="regionSearch">
                                    <datalist id="regions">
                                        <select>
                                            <option v-for="region in regionList" v-bind:value="region.name" v-on:keyup.enter="regionSearch">{{ region.name }} - {{ region.abbreviation}}</option>
                                        </select>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Domaines</label>
                                    <input list="areas" type="text" class="form-control" v-model="areasearch" v-on:keyup="areaSearch" @mouseleave="filterCorporates">
                                    <datalist id="areas">
                                        <select>
                                            <option v-for="area in areaList" v-bind:value="area.name">{{ area.name }}</option>
                                        </select>
                                    </datalist>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Recherche</label>
                                    <input type="text" class="form-control" v-model="namesearch"  @mouseleave="filterCorporates" v-on:keyup="filterCorporates" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="mailsToSend">
                        <div class="col-lg-12">
                            <h3>Envoyer à : </h3>
                            <div class="table-header">
                                <div class="col-lg-1">
                                    #
                                </div>
                                <div class="col-lg-3">
                                    Entreprise
                                </div>
                                <div class="col-lg-1">
                                    Canton
                                </div>
                                <div class="col-lg-4">
                                    Ville
                                </div>
                                <div class="col-lg-3">
                                    Adresse
                                </div>
                            </div>
                            <div class="recipient-list-scrollable-area col-lg-12">
                                <div class="to-deliver-list-item col-lg-12" v-for="mail in mailsToSend">
                                    <div class="col-lg-1"><span class="ion-checkmark-circled"></span></div>
                                    <div class="col-lg-3">{{ mail.name }}</div>
                                    <div class="col-lg-1">{{ mail.canton_abbreviation }}</div>
                                    <div class="col-lg-4">{{ mail.city }}</div>
                                    <div class="col-lg-3">{{ mail.adresse }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <h3>Résultats : </h3>
                                <div class="table-header">
                                    <div class="col-lg-1">
                                        #
                                    </div>
                                    <div class="col-lg-3">
                                        Entreprise
                                    </div>
                                    <div class="col-lg-1">
                                        Canton
                                    </div>
                                    <div class="col-lg-4">
                                        Ville
                                    </div>
                                    <div class="col-lg-3">
                                        Adresse
                                    </div>
                                </div>

                            </div>
                            <div class="recipient-list-scrollable-area col-lg-12">
                                <div class="corporate-list-item col-lg-12" v-for="corporate in corporateFiltered" v-if="corporate" @click="putTomailsToSend(corporate)">
                                    <div class="col-lg-1"><span class="ion-paper-airplane"></span></div>
                                    <div class="col-lg-3">{{ corporate.name }}</div>
                                    <div class="col-lg-1">{{ corporate.canton_abbreviation }}</div>
                                    <div class="col-lg-4">{{ corporate.city }}</div>
                                    <div class="col-lg-3">{{ corporate.adresse }}</div>
                                </div>
                            </div>
                            <!--
                            <div class="col-lg-12">
                                <span class="ion-plus-round align-center ion-btn" ></span>
                            </div>
                            -->
                            <div v-if="loadingdata" class="preloader-wrapper small active">
                                <div class="spinner-layer spinner-green-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div><div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                    <div class="circle-clipper right"></div>
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="saveRecipientList"><span class="ion-checkmark-round"></span></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userKey : '',
                sendable : true,
                loadingdata: false,
                namesearch: '',
                mailsearch: '',
                mailsToSend: [],
                corporatesearch: '',
                regionsearch: '',
                areasearch: '',
                searchError: null,
                areaList: '',
                regionList: '',
                recipientsList : '',
                corporateFiltered: ''
            }
        },
        created() {
            var apiKey = document.getElementById('userKey').value;
            this.userKey = apiKey;
        },
        watch: {
            recipientsList: function()
            {
                this.$emit('input', this.recipientsList);
            }
        },
        methods: {
            putTomailsToSend: function(contact)
            {
                if(this.mailsToSend == [])
                {
                    this.mailsToSend = this.mailsToSend.concat(contact); // if mailsToSend dont contain this contact add this one
                    this.$emit('input', this.mailsToSend);
                }else{
                    var containThisContact = false;
                    for(var i = 0; i <= this.mailsToSend.length; i++ )
                    {
                        if(this.mailsToSend[i] == contact)
                        {
                            containThisContact = true;
                        }
                    }

                    if(containThisContact === false)
                    {
                        this.mailsToSend = this.mailsToSend.concat(contact); // if mailsToSend dont contain this contact add this one
                        this.$emit('input', this.mailsToSend);

                    }

                    if(containThisContact === true)
                    {
                        for(var i = 0; i <= this.mailsToSend.length; i++ )
                        {
                            if(this.mailsToSend[i] == contact)
                            {
                                this.mailsToSend.splice([i], 1);
                            }
                        }
                    }
                }

            },
            refreshMailSearch: function()
            {
                if(this.mailsearch.length > 1)
                {

                    axios.get('/api/search/recipient?q='+this.mailsearch)
                            .then((response) => {

                                console.log(response.data);
                                var self = this;
                                this.recipientsList = response.data;

                            })
                            .catch((error) => {

                                console.log(error);
                                //TODO: add error msg

                            });

                }
            },
            regionSearch: function()
            {
                if(this.regionsearch.length > 0)
                {

                            axios.get('/api/search/region?region='+this.regionsearch+'&api_token='+this.userKey)
                            .then((response) => {

                                //console.log(response.data);
                                var self = this;
                                this.regionList = response.data;

                            })
                            .catch((error) => {
                                console.log(error);
                                //TODO: add error msg
                            });

                }
            },
            areaSearch: function()
            {
                if(this.areasearch.length > 0)
                {
                    axios.get('/api/search/area?area='+this.areasearch+'&api_token='+this.userKey)
                            .then((response) => {

                                //console.log(response.data);
                                var self = this;
                                this.areaList = response.data;

                            })
                            .catch((error) => {

                                //console.log(error);
                                //TODO: add error msg

                            });
                }
            },
            filterCorporates: function()
            {
                if(this.regionsearch != "" || this.namesearch != "" || this.corporatesearch != "")
                {
                    this.loadingdata = true;

                    axios.get('/api/search/corporate?region='+this.regionsearch+'&area='+this.areasearch+'&name='+this.namesearch+'&api_token='+this.userKey, {

                        region: this.regionsearch

                    })
                            .then((response) => {
                                this.corporateFiltered = "";
                                //console.log(response.data);
                                this.corporateFiltered = response.data;
                                this.loadingdata = false;

                            })
                            .catch((error) => {

                                console.log(error);
                                //TODO: add error msg


                            });
                }
            },
            saveRecipientList: function()
            {

            }
        }
    }
</script>

<style lang="css">
    table{
        width: 100%;
    }
    tbody{
        display: block;
        width: 100%;
    }

    .recipient-list-scrollable-area{
        height: 150px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .to-deliver-list-item{
        width: 100%;
    }

    .animate {
        -webkit-animation: appear-anim 1s;
        -moz-animation: appear-anim 1s;
        -o-animation: appear-anim 1s;
        animation: appear-anim 1s;
        opacity: 0;
    }
    @keyframes appear-anim {
        0% {
            opacity: 0;
        }
        49% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        99% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    @-webkit-keyframes appear-anim {
        0% {
            opacity: 0;
        }
        49% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        99% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    @-moz-keyframes appear-anim {
        0% {
            opacity: 0;
        }
        49% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        99% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    @-o-keyframes appear-anim {
        0% {
            opacity: 0;
        }
        49% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        99% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    @keyframes appear-anim {
        0% {
            opacity: 0;
        }
        49% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        99% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
</style>
