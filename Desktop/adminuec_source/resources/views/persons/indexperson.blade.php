@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Listado De Representantes</div>

                <div class="panel-body">
                    <div>
                        <table class="table bordered">
                            <tr>
                                <th>Representante</th>
                                <th>Acciones</th>
                                <th>Cant. Representados</th>
                                <th>Representados</th>
                            </tr>
                            @foreach($persons as $person)
                                <tr>
                                    <td>
                                        {{ $person->fullName }}
                                    </td>
                                    @foreach($person->representants as $representant)
                                        <td>
                                            <a href="{{ route('editPerson', $representant->id ) }}"><i class="fa fa-pencil fa-fw"></i></a>

                                        </td>
                                        <td>
                                            {{ $representant->hasStudent() }}
                                        </td>
                                        <td>
                                            @foreach($representant->students as $student)
                                                <a href="{{ route('createPayment', $student->id ) }}"><i class="fa fa-usd" aria-hidden="true"></i></a>


                                                <a href="{{ route('editStudent', $student->id ) }}"><i class="fa fa-pencil fa-fw"></i></a>
                                                    {{ $student->person->fullName  }}
                                                <br>
                                            @endforeach
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>

                        {{ $persons->render() }}
                        Mostrando: {{ $persons->perPage() }} por pagina

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
