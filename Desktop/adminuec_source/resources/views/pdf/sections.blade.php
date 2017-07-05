Estudiantes por seccion

<div class="container">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-3">
            <table border="1">
                <tr>
                    <td>
                        Nombres
                    </td>
                </tr>
                @foreach($students as $student)
                    <tr>
                        <td>
                            {{ $student->person->FullName }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>