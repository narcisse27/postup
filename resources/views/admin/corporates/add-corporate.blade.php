@extends('admin.layouts.default-admin-layout')

@section('title')
Ajouter une entreprise
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <dic class="card">
                <div class="header">
                    Ajouter une entreprise
                </div>
                <div class="content">
                    <form class="form-horizontal" method="post" action="{{ route('addManuallyCorporate') }}">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputName" class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Nom de l'entreprise" name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputEmail" placeholder="email" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFirstname" class="col-lg-2 control-label">Prénom du contact</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputFirstname" placeholder="Prénom du contact"
                                           name="contact_firstname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLastname" class="col-lg-2 control-label">Nom du contact</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputLastname" placeholder="Nom du contact"
                                           name="contact_lastname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdresse" class="col-lg-2 control-label">Adresse de l'entreprise</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputAdresse" placeholder="Adresse" name="adresse">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNPA" class="col-lg-2 control-label">NPA</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" id="inputNPA" placeholder="NPA" name="npa">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCity" class="col-lg-2 control-label">Ville</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputCity" placeholder="Ville" name="city">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select" class="col-lg-2 control-label">Domaine</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="select" name="area_id[]" multiple="multiple">
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select" class="col-lg-2 control-label">Canton</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="select" name="canton_id">
                                        @foreach($cantons as $canton)
                                            <option value="{{ $canton->id }}">{{ $canton->abbreviation }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    {{ csrf_field() }}
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </dic>

        </div>
    </div>
@endsection