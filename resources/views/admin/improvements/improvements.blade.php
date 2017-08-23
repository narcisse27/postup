@extends('admin.layouts.default-admin-layout')


@section('title')
Propositions d'améliorations
@endsection

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h4 class="title">
                    Améliorations proposées
                </h4>
            </div>
            <div class="body">
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Objet</th>
                                <th>User_id</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($features as $feature)
                                <tr>
                                    <td><a href="/administrator/improvements/{{$feature->id}}">{{  $feature->id  }}</a></td>
                                    <td><a href="/administrator/improvements/{{$feature->id}}">{{  $feature->object  }}</a></td>
                                    <td><a href="/administrator/user/{{$feature->user_id}}">{{  $feature->user_id }}</a></td>
                                    <td>{{ Carbon\Carbon::parse($feature->created_at)->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
