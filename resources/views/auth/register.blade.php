@extends('auth.auth-template')

@section('title')
    Me connecter - postu'up
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Post'up</h1>
                <p>Enregistrez vous pour continuer</p>
                <p style="height:100px; overflow-y: scroll;">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At debitis et inventore ipsum, odio pariatur porro qui ratione ut voluptatum! Asperiores doloremque error et laudantium maiores placeat praesentium tempora voluptas!
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, amet, consequuntur distinctio ex fuga inventore, ipsam ipsum nisi nulla odit praesentium quidem repellat sunt temporibus voluptatem. Alias ipsa quidem soluta.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dicta distinctio dolorem eius excepturi, exercitationem explicabo illum in maiores natus, officia officiis ullam voluptate? Error fugit magni minus nulla possimus.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem distinctio, explicabo facilis ipsa iusto nihil officiis pariatur quos tempore tenetur? Accusamus amet explicabo fugiat itaque minus nobis numquam repellendus velit!

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At debitis et inventore ipsum, odio pariatur porro qui ratione ut voluptatum! Asperiores doloremque error et laudantium maiores placeat praesentium tempora voluptas!
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, amet, consequuntur distinctio ex fuga inventore, ipsam ipsum nisi nulla odit praesentium quidem repellat sunt temporibus voluptatem. Alias ipsa quidem soluta.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dicta distinctio dolorem eius excepturi, exercitationem explicabo illum in maiores natus, officia officiis ullam voluptate? Error fugit magni minus nulla possimus.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem distinctio, explicabo facilis ipsa iusto nihil officiis pariatur quos tempore tenetur? Accusamus amet explicabo fugiat itaque minus nobis numquam repellendus velit!

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At debitis et inventore ipsum, odio pariatur porro qui ratione ut voluptatum! Asperiores doloremque error et laudantium maiores placeat praesentium tempora voluptas!
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, amet, consequuntur distinctio ex fuga inventore, ipsam ipsum nisi nulla odit praesentium quidem repellat sunt temporibus voluptatem. Alias ipsa quidem soluta.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dicta distinctio dolorem eius excepturi, exercitationem explicabo illum in maiores natus, officia officiis ullam voluptate? Error fugit magni minus nulla possimus.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem distinctio, explicabo facilis ipsa iusto nihil officiis pariatur quos tempore tenetur? Accusamus amet explicabo fugiat itaque minus nobis numquam repellendus velit!
                </p>
                <br>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label for="lastname" class="col-md-4 control-label">Nom</label>

                        <div class="col-md-6">
                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                            @if ($errors->has('lastname'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <label for="firstname" class="col-md-4 control-label">Prénom</label>

                        <div class="col-md-6">
                            <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

                            @if ($errors->has('firstname'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('areas_id') ? ' has-error' : '' }}">
                        <label for="areas" class="col-md-4 control-label">Domaine professionel</label>

                        <div class="col-md-6">
                            <select name="area_id" id="">
                                @foreach($data as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('areas_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('areas_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Mot de passe</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmez mot de passe</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="" style="background-image: url('../assets/landing/img/btn-gradiant-tmplate-manager.jpg'); border-radius: 20px; border: 0px; color:white;">
                                M'enrengistrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
