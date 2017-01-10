@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">BIENVENIDO A </div>

                    <div class="panel-body">
                        LOGIN PARA ENTRAR
                        <p>
                            @include('components.share', ['url' => 'http://blog.damirmiladinov.com/'])
                        </p>
                    </div>
                </div>
                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>

        </div>

    </div>


@endsection