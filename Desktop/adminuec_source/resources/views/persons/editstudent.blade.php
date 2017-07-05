@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Editando a: </div>
                    <div class="well"> <h4>
                            Nombres: <strong>{{ $student->person->first_name }}
                            {{ $student->person->last_name }}</strong>
                            Cédula: <strong>{{ $student->person->cedula }}</strong>
                            Grado: <strong>{{ $student->curse->name }}</strong>
                            Representante: <strong>{{ $student->representant->person->FullName }}</strong>
                        </h4></div>

                <div class="panel-body">
                    <div>

                            <form class="form-horizontal" id="form1" action="{{ route('updateStudent') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="cedula" class="col-sm-2 control-label">Cédula</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $student->person->cedula}}" maxlength="8" minlength="7" required="required" name="cedula" class="form-control" id="cedula" placeholder="Cedula">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $student->person->first_name}}" required="required" name="first_name" class="form-control" id="nombre" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido" class="col-sm-2 control-label">Apellido</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $student->person->last_name}}" required="required" name="last_name" class="form-control" id="apellido" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono" class="col-sm-2 control-label">Teléfono</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $student->person->phone}}" maxlength="11" required="required" name="phone" class="form-control" id="telefono" placeholder="Teléfono Celular">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono2" class="col-sm-2 control-label">Teléfono</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $student->person->phone_home}}"  maxlength="11" required="required" name="phone_home" class="form-control" id="telefono2" placeholder="Teléfono De Casa">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" value="{{ $student->person->email}}"  required="required" name="email" class="form-control" id="email" placeholder="Correo Electrónico">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="col-sm-2 control-label">Dirección</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $student->person->address}}" required="required" name="address" class="form-control" id="direccion" placeholder="Direccion De Habitación">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profesion" class="col-sm-2 control-label">Profesion</label>
                                        <div class="col-sm-10">
                                            <select name="curse_id" id="" required="required">
                                                <option value="{{ $student->curse->id}}">[{{ $student->curse->name}}]</option>
                                                @foreach($curses as $curse)
                                                    <option value = "{{ $curse->id }}">{{ $curse->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label for="representant" class="col-sm-2 control-label">Representant</label>
                                    <div class="col-sm-10">
                                        <select name="representant_id" id="" required="required">
                                            <option value="{{ $student->representant->id}}">[{{ $student->representant->person->FullName}}]</option>
                                            @foreach($representants as $representant)
                                                <option value = "{{ $representant->id }}">{{ $representant->person->FullName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="role" value="parent" >
                                <input type="hidden" name="person_id" value="{{ $student->person->id }}" >
                                <input type="hidden" name="student_id" value="{{ $student->id }}" >
                                <input type="hidden" name="role" value="student" >

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
