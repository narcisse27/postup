@extends('admin.layouts.default-admin-layout')

@section('title')
    Gestion des utilisateurs
@endsection

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h4 class="title">
                    Utilisateurs
                </h4>
            </div>
            <div class="body">

                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr><th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Mail</th>
                            <th>Mails reserve</th>
                            <th>Inscription</th>
                        </tr></thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><a href="/administrator/user/{{$user->id}}">{{  $user->id  }}</a></td>
                                <td><a href="/administrator/user/{{$user->id}}">{{  $user->firstname  }}</a></td>
                                <td><a href="/administrator/user/{{$user->id}}">{{  $user->lastname  }}</a></td>
                                <td><a href="/administrator/user/{{$user->id}}">{{  $user->email  }}</a></td>
                                <td>{{ $user->mails_reserve }}</td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>
@endsection