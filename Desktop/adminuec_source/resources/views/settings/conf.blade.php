@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Costo De La Mensualidad</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('storeSettingCost') }}">

                        {{ csrf_field() }} <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"  > -->

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Costo Nuevo De La Mensualidad</label>

                                <div class="col-md-6">
                                    <input id="mensualidad" type="text" maxlength="5" minlength="4" class="form-control" name="costmonth" >
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
                            <div class="form-group">
                                Costos Historicos De Las Mensualidades

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>
                                                Costo
                                            </th>
                                            <th>
                                                Fecha del aumento
                                            </th>
                                        </tr>
                                        @foreach($costs as $cost)
                                            <tr>
                                                <td>
                                                    {{ $cost->name }}
                                                </td>
                                                <td>
                                                    {{  $cost->created_at->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                            </div>
                        {{ $costs->render() }}
                    </div>
                </div>

            </div>

            <div class="col-md-5 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar costo De La Inscripcion</div>
                    <div class="panel-body"><p></p>
                        <form method="POST" action="{{ route('storeSettingInsc') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="" class="col-sm-4">Costo Nuevo De Inscripcion Actual</label>
                                <div class="col-sm-8">
                                    <input type="text" id="inscripcion" maxlength="5" minlength="4" class="form-control" name="insc_cost">
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
                        <div class="form-group">
                            Costos historicos de las inscripciones

                            <table class="table table-bordered">
                                <tr>
                                    <th>
                                        Costo
                                    </th>
                                    <th>
                                        Fecha del aumento
                                    </th>
                                </tr>
                                @foreach($inscs->sortByDesc('created_at') as $insc)
                                    <tr>
                                        <td>
                                            {{ $insc->name }}
                                        </td>
                                        <td>
                                            {{  $insc->created_at->format('d-m-Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        {{ $inscs->render() }}
                    </div>
                </div>
            </div>
            <div class="col-md-5 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Inicio De Fecha De Periodo: <strong>{{ $dateinsc->name }}</strong></div>
                    <div class="panel-body"><p></p>
                        <form method="POST" action="{{ route('updateSettingDate') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="" class="col-sm-4">Fecha de inicio de periodo</label>
                                <div class="col-sm-8">
                                    <input type="date" required="required" class="form-control" name="date">
                                </div>
                            </div>
                            <div class="form-group">
                                <div  align="center">
                                    <input type="submit"  class="btn btn-danger btn-lg" value="Activar Nueva Fecha">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Iniciar nuevo periodo.</div>
                <div class="panel-body"><p>
                        Periodo Actual: <strong>{{ $period->name }}</strong>
                    </p>
                    <form method="POST" action="{{ route('storeSettingPeriod') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div  align="center">
                            <input type="submit" class="btn btn-danger btn-lg" value="Activar Nuevo Periodo">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
