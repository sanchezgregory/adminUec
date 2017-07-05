@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de pagos</div>
                <div class="panel-body">
                    <div>
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                   Num
                                </th>
                                <th>
                                    Estudiante
                                </th>
                                <th>
                                    Fecha
                                </th>
                                <th>
                                    Total
                                </th>
                                <th>
                                    Pago de:
                                </th>
                            </tr>
                            @foreach($payments as $payment)
                            <tr>
                                <td>
                                    {{ $payment->id }}
                                </td>
                                <td>
                                    {{ $payment->student->person->fullName }}
                                </td>
                                <td>
                                    {{ $payment->created_at }}
                                </td>
                                <td>
                                    {{ $payment->total }}
                                </td>

                                <td>
                                    @foreach($payment->months as $month)
                                        @if ($month->name == null) <li>Inscripcion</li>
                                        @else <li> {{ $month->name }}</li>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        {{ $payments->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
