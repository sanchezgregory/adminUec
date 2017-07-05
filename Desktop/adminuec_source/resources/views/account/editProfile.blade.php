@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Usuario y Avatar</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">

                        {{ csrf_field() }} <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"  > -->

                            {{ method_field('PUT') }}
                            <div class="form-group" align="center">
                                @if ($user->img == NULL)
                                    <img src="{{ asset("storage/avatars/default.png")}}" alt="Avatar" height="200" width="200" class="img-thumbnail" >
                                @else
                                    <img src="{{ asset("storage/".$user->img) }}" alt="Avatar" height="200" width="200" class="img-thumbnail" >
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" value="{{ $user->username }}" class="form-control" name="username" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="img" class="col-md-4 control-label">Avatar</label>

                                <div class="col-md-6">
                                    <input id="img" type="file" name="img" value="{{ old('img') }}" >
                                </div>

                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>



            <div class="col-md-5 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Cambiar Password</div>
                    <div class="panel-body"><p></p>
                        <form method="POST" action="{{ route('postPassword') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="" class="col-sm-4">Password Actual</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="current_password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4">Password Nuevo</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4">Confirme password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Datos Personales</div>
                    <div class="panel-body"><p></p>
                        <form method="POST" action="{{ route('postPassword') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="" class="col-sm-4">Cedula:</label>
                                <div class="col-sm-8">
                                    @if (Auth()->user()->role == 'admin')
                                        <input type="text" value="{{ $user->person->cedula }}" class="form-control" name="first_name">
                                    @else
                                        <input type="text" disabled value="{{ $user->person->cedula }}" class="form-control" name="first_name">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4">Nombre:</label>
                                <div class="col-sm-8">
                                    @if (Auth()->user()->role == 'admin')
                                    <input type="text" value="{{ $user->person->first_name }}" class="form-control" name="first_name">
                                        @else
                                        <input type="text" disabled value="{{ $user->person->first_name }}" class="form-control" name="first_name">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4">Apellido:</label>
                                <div class="col-sm-8">
                                    @if (Auth()->user()->role == 'admin')
                                        <input type="text" value="{{ $user->person->last_name }}" class="form-control" name="last_name">
                                    @else
                                        <input type="text" disabled value="{{ $user->person->last_name }}" class="form-control" name="last_name">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4">Telefono</label>
                                <div class="col-sm-8">
                                    <input type="text" value="{{ $user->person->phone_home }}" class="form-control" name="phone_home">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-4">Celular</label>
                                <div class="col-sm-8">
                                    <input type="text" value="{{ $user->person->phone }}" class="form-control" name="phone">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-4">Direccion</label>
                                <div class="col-sm-8">
                                    <input type="text" value="{{ $user->person->address }}"class="form-control" name="address">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
