@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Cargando pagos al sistema</div>

                <div class="panel-body">
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#mensualidad" aria-controls="mensualidad" role="tab" data-toggle="tab">Mensualidad</a></li>
                            <li role="presentation"><a href="#inscripcion" aria-controls="inscripcion" role="tab" data-toggle="tab">Inscripcion</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="mensualidad">
                                <h4>Representante:{{ $student->representant->person->FullName }} </h4>
                                <h5>Mensualidad de:
                                    <strong>{{ $student->person->first_name}} {{ $student->person->last_name }} </strong>
                                    Ced: <strong> {{ $student->person->cedula }}</strong>
                                    Fecha: <strong> {{ $now->toFormattedDateString() }}</strong>
                                    Grado: <strong> {{ $student->curse->name }}</strong>
                                </h5>
                                <h4>Periodo actual: {{ $period->name }}</h4>
                                <p></p>
                                <form class="form-horizontal" id="form1" action="{{ route('storePayment') }}" method="post">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                    <input type="hidden" name="fecha" value="{{ $now }}">

                                    <div class="form-group">
                                        <label for="cedula" class="col-sm-2 control-label">Meses disponibles a pagar </label>
                                        <div class="col-sm-10">
                                            <select id='pre-selected-options' name="months[]" multiple='multiple' required>
                                                @foreach($months as $month)
                                                    <option class="operatons" data-monto="{{ $month->cost }}" value="{{ $month->id }}">{{ $month->month }}
                                                        Bs: {{ $month->cost }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-4">
                                            <button type="submit"  class="btn btn-default">Aceptar</button>
                                        </div>
                                    </div>
                                </form>

                                <table class="table table-hover" id="datapayment">
                                    <thead>
                                    <tr>
                                        <td>Pago Numero:</td>
                                        <td>Total del pago </td>
                                        <td>Fecha del pago</td>
                                        <td>Meses pagados</td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="inscripcion">
                                <div role="tabpanel" class="tab-pane active" id="mensualidad">
                                    <h4>Representante: {{ $student->representant->person->FullName }} </h4>
                                    <h5>Inscripcion de:
                                        <strong>{{ $student->person->first_name}} {{ $student->person->last_name }} </strong>
                                        Ced: <strong> {{ $student->person->cedula }}</strong>
                                        Fecha: <strong> {{ $now->toFormattedDateString() }}</strong>
                                        Grado Actual: <strong> {{ $student->curse->name }}</strong>
                                    </h5>
                                <form id="form2" class="form-horizontal" action="{{ route('storePayment2') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                    <div class="form-group">
                                        <label for="period" class="col-sm-2 control-label">Periodo a Inscribir</label>
                                        <div class="col-sm-4">
                                            <h4>{{ $period->name }}</h4>
                                        </div>
                                        <label for="period" class="col-sm-2 control-label">Grado a inscribir</label>
                                        <div class="col-sm-4">
                                            <select required="required" name="curse_id" class="form-control" id="period">
                                                @foreach($curses as $curse)
                                                    <option value="{{ $curse->id }}">{{ $curse->name }}</option>
                                                @endforeach
                                                    <option value="{{ $student->curse_id }}">{{ $student->curse->name }}(Repetir)</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">
                                                Retirar estudiante
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-2 control-label">Total</label>
                                        <div class="col-sm-4">
                                            <input type="text"  required="required" readonly name="total" class="form-control" id="incripcionpagada" value="{{ $costInsc }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit"  class="btn btn-default">Aceptar</button>
                                        </div>
                                    </div>
                                    <input type="hidden" value="1" name="period_id">
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Retirar al estudiante: {{ $student->person->FullName }}</h4>
                </div>
                <div class="modal-body">
                    Nota: Este estudiante puede ser incorporado mas adelante.
                </div>
                <div class="modal-footer">
                    <form method="get" action="{{ route('destroyStudent',$student->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-danger">Retirar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#pre-selected-options').on('change', function (event) {
            console.log(event.target.value);
        })

        var valores = 0;

        var ids = [0];

        function suma(m, id) {

            var bandera = true;

            ids.forEach(function (element, index) {
                if(element == id){
                    bandera = false;
                    ids.slice(index, 1);
                }else{
                    ids.push(id);
                    bandera = true;
                }
            });

            if (bandera){
                valores = valores + parseInt(m, 10);
            }else{
                valores = valores - parseInt(m, 10);
            }

            console.log(valores, ids, suma);

        }

        $(document).ready(function () {
            $('#months').select2({
                tags: true,
                tokenSeparators: [',']
            });
        });




           $('#datapayment').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{!! route('dataPayment',$student->id) !!}',
               searching: false,
               "order": [[2, 'desc']],
               columns: [
                   { data: 'id', name: 'id', searchable: false },
                   { data: 'total', name: 'total' },
                   { data: 'created_at', name: 'created_at' },
                   { data: 'months', name: 'months', searchable: true},
               ]

           });

        // run pre selected options
        $('#pre-selected-options').multiSelect();
    </script>
@endsection