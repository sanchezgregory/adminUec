@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cambia tu password</div>
                    @include('partials.errors')
                    <div class="panel-body">
                        Sigue las instrucciones:
                        <form method="POST" action="{{ route('postPassword') }}">
                            {{ csrf_field() }}
                            <input type="password" name="current_password">
                            <input type="password" name="password">
                            <input type="password" name="password_confirmation">
                            <button type="submit" class="btn btn-primary">cambiar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection