@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading" align="center"> <H4> MODULO DE REGISTRO </H4> </div>

                <div class="panel-body">
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#representante" aria-controls="representante" role="tab" data-toggle="tab">Representantes</a></li>
                            <li role="presentation"><a href="#estudiante" aria-controls="estudiante" role="tab" data-toggle="tab">Estudiantes</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="representante">
                                <h2>Representantes</h2>
                                <form class="form-horizontal" id="form1" action="{{ route('storePerson') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="cedula" class="col-sm-2 control-label">Cédula</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="cedula" maxlength="8" minlength="7" required="required" name="cedula" value="{{ old('cedula') }}" class="form-control" placeholder="Cedula">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="30" pattern="[A-Za-z]{4-16}" required="required" value="{{ old('first_name') }}" name="first_name" class="form-control" id="nombre" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido" class="col-sm-2 control-label">Apellido</label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="30" required="required" value="{{ old('last_name') }}" name="last_name" class="form-control" id="apellido" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono" class="col-sm-2 control-label">Teléfono (movil)</label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="11" required="required" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="Telefóno personal">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono2" class="col-sm-2 control-label">Teléfono (casa) </label>
                                        <div class="col-sm-10">
                                            <input type="text" required="required" name="phone_home" maxlength="11" value="{{ old('phone_home') }}" class="form-control" id="phone2" placeholder="Teléfono de Casa">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email"  value="{{ old('email') }}" name="email" class="form-control" id="email" placeholder="Correo electrónico">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="col-sm-2 control-label">Dirección</label>
                                        <div class="col-sm-10">
                                            <input type="text" required="required" value="{{ old('address') }}" name="address" class="form-control" id="direccion" placeholder="Dirección de habitación">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profesion" class="col-sm-2 control-label">Nivel de Instrucción</label>
                                        <div class="col-sm-10">
                                            <select name="proffession_id" id="" required="required">
                                                <option value="">Seleccione un nivel</option>
                                                @foreach($proffessions as $proffession)
                                                    <option value = "{{ $proffession->id }}">{{ $proffession->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="role" value="parent" >

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="repre" class="btn btn-default">Aceptar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="estudiante">
                                <h2>Estudiantes</h2>
                                <form id="form2" class="form-horizontal" action="{{ route('storePerson') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="cedula" class="col-sm-2 control-label">Cédula</label>
                                        <div class="col-sm-10">
                                            <input type="text" required="required" value="{{ old('cedula') }}" maxlength="8" minlength="7" name="cedula" class="form-control" id="cedulaest" placeholder="Cédula">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" required="required" value="{{ old('first_name') }}" maxlength="20" minlength="2" name="first_name" class="form-control" id="nombreest" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido" class="col-sm-2 control-label">Apellido</label>
                                        <div class="col-sm-10">
                                            <input type="text" required="required" value="{{ old('last_name') }}" maxlength="20" minlength="2" name="last_name" class="form-control" id="apellidoest" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono" class="col-sm-2 control-label">Teléfono</label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="11" minlength="11" required="required" value="{{ old('phone') }}" name="phone" class="form-control" id="phoneest" placeholder="Telefono celular">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono2" class="col-sm-2 control-label">Teléfono</label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="11" minlength="11" value="{{ old('phone_home') }}" name="phone_home" class="form-control" id="phoneest2" placeholder="Telefono de Casa">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" required="required" value="{{ old('email') }}" name="email" class="form-control" id="email" placeholder="Correo electronico">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="col-sm-2 control-label">Dirección</label>
                                        <div class="col-sm-10">
                                            <input type="text" required="required" value="{{ old('address') }}" name="address" class="form-control" id="direccion" placeholder="Direccion de habitacion">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="curse"  class="col-sm-2 control-label">Grado a inscrbir</label>
                                        <div class="col-sm-10">

                                            <select name="curse_id" id="curse" required="required">
                                                <option value="">Seleccione el grado</option>
                                                @foreach($curses as $curse)
                                                    <option value = "{{ $curse->id }}">{{ $curse->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="representante"  class="col-sm-2 control-label">Representante</label>
                                        <div class="col-sm-10">

                                                <select name="representant_id" id="representante" required="required">
                                                    <option value="">Seleccione su representante</option>
                                                    @foreach($representants as $representant)
                                                        <option value = "{{ $representant->id }}">{{ $representant->person->fullName }}</option>
                                                    @endforeach
                                                </select>

                                        </div>
                                    </div>

                                    <input type="hidden" name="role" value="student" >

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="stud" class="btn btn-default">Aceptar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection