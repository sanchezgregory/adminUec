@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Editando a: </div>
                    <div class="well"> <h3>
                            {{ $representant->person->first_name }}
                            {{ $representant->person->last_name }}
                            {{ $representant->person->cedula }}
                            {{ $representant->proffession->name }}</h3></div></h3>

                <div class="panel-body">
                    <div>

                            <form class="form-horizontal" id="form1" action="{{ route('updatePerson') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="cedula" class="col-sm-2 control-label">cédula</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $representant->person->cedula}}" maxlength="8" minlength="7" required="required" name="cedula" class="form-control" id="cedula" placeholder="Cedula">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $representant->person->first_name}}" required="required" name="first_name" class="form-control" id="nombre" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido" class="col-sm-2 control-label">Apellido</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $representant->person->last_name}}" required="required" name="last_name" class="form-control" id="apellido" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono" class="col-sm-2 control-label">Teléfono</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $representant->person->phone}}" required="required" name="phone" maxlength="11" class="form-control" id="telefono" placeholder="Teléfono Celular">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono2" class="col-sm-2 control-label">Teléfono</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $representant->person->phone_home}}" required="required" maxlength="11" name="phone_home" class="form-control" id="telefono2" placeholder="Teléfono De Casa">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" value="{{ $representant->person->email}}" maxlength="11" required="required" name="email" class="form-control" id="email" placeholder="Correo electrónico">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="col-sm-2 control-label">Dirección</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $representant->person->address}}" required="required" name="address" class="form-control" id="direccion" placeholder="Dirección De Habitación">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profesion" class="col-sm-2 control-label">Grado De Instrucción</label>
                                        <div class="col-sm-10">
                                            <select name="proffession_id" id="" required="required">
                                                <option value="{{ $representant->proffession->id}}">[{{ $representant->proffession->name}}]</option>
                                                @foreach($proffessions as $proffession)
                                                    <option value = "{{ $proffession->id }}">{{ $proffession->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                <input type="hidden" name="role" value="parent" >
                                <input type="hidden" name="person_id" value="{{ $representant->person->id }}" >
                                <input type="hidden" name="representant_id" value="{{ $representant->id }}" >

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit"  class="btn btn-default">Aceptar</button>
                                        </div>
                                    </div>
                                </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
