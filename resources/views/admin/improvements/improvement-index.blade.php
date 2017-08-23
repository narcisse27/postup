@extends('admin.layouts.default-admin-layout')

@section('title')
    Hello
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h3>
                    {{ $feature->object }}
                </h3>
            </div>
            <div class="body">
                <p>
                    {{ $feature->content }}
                </p>
                <br>
                <hr>
                {{ Carbon\Carbon::parse($feature->created_at)->format('d/m/Y') }} par <a href="/user/{{  $user->id }}">{{  $user->firstname }} {{ $user->lastname }}</a>
            </div>
        </div>
    </div>
@endsection
