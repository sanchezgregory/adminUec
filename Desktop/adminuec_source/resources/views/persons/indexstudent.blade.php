@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Listado De Estudiantes Por Grado</div>

                <div class="panel-body">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($curses as $curse)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$curse->id}}" aria-expanded="false" aria-controls="collapse{{$curse->id}}">
                                        {{ $curse->name }}
                                    </a>
                                    <a href="{{ route('sections.pdf', $curse->id) }}">pdf</a>
                                </h4>
                            </div>
                            <div id="collapse{{$curse->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>
                                                Estudiante
                                            </th>
                                            <th>
                                                Representante
                                            </th>
                                            <th>
                                                Celular
                                            </th>
                                            <th>
                                                Telf. Casa
                                            </th>
                                            <th>
                                                Dirección
                                            </th>
                                        </tr>
                                        @foreach($curse->students as $student)

                                                <tr>
                                                    <td>
                                                        {{ $student->person->FullName }}

                                                    </td>
                                                    <td>
                                                        {{ $student->representant->person->FullName }}
                                                    </td>
                                                    <td>
                                                        {{ $student->representant->person->phone }}
                                                    </td>
                                                    <td>
                                                        {{ $student->representant->person->phone_home }}
                                                    </td>
                                                    <td>
                                                        {{ $student->representant->person->address }}
                                                    </td>
                                                </tr>
                                        @endforeach
                                    </table>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
