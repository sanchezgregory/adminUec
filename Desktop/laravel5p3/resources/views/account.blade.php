@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ACCOUNT</div>
                @include('partials/errors')
                @include('partials/success')

                <div class="panel-body">
                    Perfil del usuario
                    <ul>
                        <li><a href=" {{ route('editProfile') }}">Editar perfil</a></li>
                        <li><a href="{{ route('changePassword') }}">Cambiar password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
