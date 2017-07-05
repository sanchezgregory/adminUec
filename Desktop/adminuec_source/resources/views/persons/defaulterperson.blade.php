@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de Estudiantes morosos</div>
                <ul>
                    <table class="table table-bordered">
                        <tr>
                            <th>
                               Acciones
                            </th>
                            <th>
                                Estudiante
                            </th>
                            <th>
                                Grado
                            </th>
                            <th>
                                Meses Pagados
                            </th>
                            <th>
                                Meses que debe
                            </th>
                        </tr>
                        @foreach($students as $student)
                            @if ($student->meses <= 3) <tr bgcolor="red">
                                @elseif($student->meses > 3 and $student->meses < 7) <tr bgcolor="orange">
                                    @else <tr bgcolor="#90ee90">
                                @endif
                                <td  bgcolor="#fff">
                                    <a href="{{ route('createPayment', $student->stud) }}"><span class="glyphicon glyphicon-usd" aria-hidden="true"></a>
                                    <a href="{{ route('personMail', $student->stud) }}"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></a>
                                </td>
                                <td>
                                    {{ $student->first_name }}
                                    {{ $student->last_name }}
                                </td>
                                <td>
                                    {{ $student->name }}
                                </td>
                                <td>
                                    <span class="badge">{{ $student->meses }}</span>
                                </td>
                                <td>
                                    <span class="badge">{{ $nm - $student->meses }}</span>
                                </td>
                            </tr>


                        @endforeach
                    </table>


                </ul>
                <hr>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
