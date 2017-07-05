@extends('layouts.app')

@section('content')
<center>
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido Usuario: {{ auth()->user()->username }}</div>

                <div class="panel-body">
                 <center> <i><h3>Sistema Administrativo</h3></i></center>  

                </div>
            </div>
        </div>
    </div>
</div>
</center>
@endsection
