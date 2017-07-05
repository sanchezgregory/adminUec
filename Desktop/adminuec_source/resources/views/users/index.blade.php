@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title }}</div>
                <div class="panel-body">
                    <ul>
                        {{ Auth()->user()->person->FullName }}
                        <table class="table responsive">
                            <tr>
                                <th>
                                    Pagos
                                </th>
                                <th>
                                    Total
                                </th>
                                <th>
                                    Meses
                                </th>
                            </tr>
                            <p>
                            @foreach( Auth()->user()->person->representants as $representant)
                                @foreach($representant->students as $student )
                                    <ol>
                                        <li>
                                            Nombre: {{ $student->person->FullName }}
                                            Grado: {{ $student->curse->name }}

                                        </li>
                                    </ol>
                                    @foreach($student->payments as $payment)
                                        <tr>
                                            <td>
                                                {{ $payment->id }}
                                            </td>
                                            <td>
                                                {{ $payment->total }}
                                            </td>
                                            <td>
                                                @foreach($payment->months as $month)
                                                    <li>{{ $month->name }} </li>
                                                @endforeach
                                            </td>
                                         </tr>
                                    @endforeach

                                @endforeach
                            @endforeach
                        </table>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
