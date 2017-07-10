<template>
    <transition name="modal">
    <div class="col s4 card">
        <div class="panel panel-default">
            <div class="panel-heading">Envoie</div>
            <div class="panel-body">
                <div class="mailer-wrapper">
                    <div class="mailer-destination-wraper col s12">
                        <div class="col s1">
                            {{ mailsToSend.length }}
                        </div>
                        <div class="col s9">
                            <input list="mails" type="text" placeholder="info@tissot ou tissot" v-on:keyup="refreshMailSearch" v-model="mailsearch" class="form-control">
                            <datalist id="mails">
                                <select>
                                    <option v-for="recipient in recipientsList" v-bind:value="recipient.email">{{ recipient.email }} {{ recipient.name}}</option>
                                </select>
                            </datalist>
                        </div>
                        <div class="col s1 ion-btn">
                            <span class="ion-plus"></span>
                        </div>
                        <div class="col s1 ion-btn">
                            <!-- Button trigger modal -->
                            <!--
                            <div data-toggle="modal" data-target="#myModal">
                                <span class="ion-navicon-round img"></span>
                            </div>
                            -->
                            <button type="button" class="waves-effect waves-light" data-darget="#modal1" data-toggle="modal">
                                <span class="ion-navicon-round"></span>
                            </button>

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Objet">
                    </div>
                    <div class="form-group">
                                <textarea name="" id="" cols="20" rows="5" class="form-control">Madame, Monsieur,
                                    Je vous propose ma candidature spontanée pour un poste de… . Afin que vous puissiez en savoir plus sur mes compétences et
                                    mes motivations, je vous joins mon CV et ma lettre de motivation.
                                    Disponible dans les plus brefs délais, je suis à votre disposition pour d’éventuelles informations complémentaires.
                                    Cordialement,
                                    Prénom Nom
                                    Numéro de téléphone
                                </textarea>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-content" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Envoi par groupe</h4>
                            </div>
                            <div class="modal-body">
                                <!-- form filter -->
                                <div class="row">
                                    <div class="col s12">

                                        <div class="col s4">
                                            <div class="form-group">
                                                <label for="">Regions</label>
                                                <input list="regions" name="region_filter" id="" class="form-control" type="text" v-model="regionsearch" v-on:keyup="regionSearch" @mouseleave="filterCorporates"
                                                >
                                                <datalist id="regions">
                                                    <select>
                                                        <option v-for="region in regionList" v-bind:value="region.name">{{ region.name }} - {{ region.abbreviation}}</option>
                                                    </select>
                                                </datalist>
                                            </div>
                                        </div>

                                        <div class="col s4">
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
                                        <div class="col s4">
                                            <div class="form-group">
                                                <label for="">Recherche</label>
                                                <input type="text" class="form-control" v-model="namesearch" v-on:keyup="regionSearch" @mouseleave="filterCorporates">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row" v-if="mailsToSend">
                                    <div class="col s12">
                                        <h3>A envoyer à : </h3>
                                        <table class="table table-striped table-hover ">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Entreprise</th>
                                                <th>Canton</th>
                                                <th>Ville</th>
                                                <th>Adresse</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="to-deliver-list-item" v-for="mail in mailsToSend">
                                                <td><span class="ion-checkmark-circled"></span></td>
                                                <td>{{ mail.name }}</td>
                                                <td>{{ mail.canton_abbreviation }}</td>
                                                <td>{{ mail.city }}</td>
                                                <td>{{ mail.adresse }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <h3>Résultats : </h3>
                                        <table class="table table-striped table-hover ">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Entreprise</th>
                                                <th>Canton</th>
                                                <th>Ville</th>
                                                <th>Adresse</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="corporate-list-item" v-for="corporate in corporateFiltered" v-if="corporate" @click="putTomailsToSend(corporate)">
                                                <td><span class="ion-paper-airplane"></span></td>
                                                <td>{{ corporate.name }}</td>
                                                <td>{{ corporate.canton_abbreviation }}</td>
                                                <td>{{ corporate.city }}</td>
                                                <td>{{ corporate.adresse }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <div v-if="loadingdata" class="preloader-wrapper small active">
                                            <div class="spinner-layer spinner-green-only">
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div><div class="gap-patch">
                                                <div class="circle"></div>
                                            </div><div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end form filter -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn pull-right" :disabled="sendable == true ? false : true">
                    <span class="ion-android-send"></span>
                </button>
            </div>
        </div>
    </div>

</template>