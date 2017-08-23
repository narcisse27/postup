@extends('admin.layouts.default-admin-layout')

@section('title')
    utilisateur {{ $user->firstname }} {{ $user->lastname }}
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                {{ $user->firstname }} {{ $user->lastname }}
            </div>
            <div class="body">
                <div class="col-lg-3">
                    <div class="">
                        <img src="{{ asset('/storage/'.$user->picture_name ) }}" alt="" class="img img-responsive">
                    </div>
                </div>
                <div class="col-lg-9">
                    {{ $user->email }} <br>
                    {{ $user->adresse }} <br>
                    {{ $user->npa }} <br>
                    {{ $user->city }} <br>
                    {{ $user->phone }} <br>
                    {{ $user->mails_reserve }} <br>
                    <form action="">
                        <button class="btn btn-warning">Supprimer</button>
                        //TODO ajouter fonctionnalité supprimer
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection