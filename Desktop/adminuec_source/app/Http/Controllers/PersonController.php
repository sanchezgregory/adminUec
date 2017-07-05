<?php

namespace App\Http\Controllers;

use App\Curse;
use App\Mail\Welcome;
use App\Month;
use App\Period;
use App\Person;
use App\Proffession;
use App\Representant;
use App\Student;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
Use Mail;

class PersonController extends Controller
{
    public function indexPerson(Request $request)
    {
        $persons = Person::with('representants.proffession','students.payments.inscriptions')->where('role','parent')->orderBy('first_name')->paginate(10);
        return view('persons/indexperson',compact('persons','students'));
        /*$persons = Person::searchPerson($request->search);

        if (isset($request->search) && empty($request->search) ) {

        }

        return view('persons/indexperson',compact('persons'));*/

    }
    public function indexStudent()
    {
        $num_month = Carbon::now()->month+4;
        $curses = Curse::with('students.person','students.representant.person','students.payments.months')
            ->get();
        return view('persons/indexstudent', compact('curses','num_month'));
    }

    public function indexUser()
    {
        $users = User::with('person','person.representants.students.payments.months');

        return view('users/indexuser', compact('users'));
    }

    public function defaulter()
    {
        $nm = Carbon::now()->month+4;
        $months = DB::table('months as t1')
            ->select(DB::raw('count(*) as meses'))
            ->Join('month_payment as t2', 't2.month_id','=','t1.id')
            ->rightJoin('payments as t3', 't3.id', '=', 't2.payment_id')
            ->rightJoin('students as t4', 't4.id','=','t3.student_id')
            ->rightJoin('persons as t5','t4.person_id','t5.id')
            ->get();

        $students = DB::table('persons as t1')
            ->select('t1.first_name','t1.last_name','t1.id','t2.id as stud' ,'t7.name', DB::raw('count(*) as meses'))
            ->join('students as t2','t2.person_id','t1.id')
            ->join('payments as t3','t3.student_id','t2.id')
            ->join('month_payment as t4','t4.payment_id','t3.id')
            ->join('months as t5','t5.id','t4.month_id')
            ->join('periods as t6','t6.id','t5.period_id')
            ->join('curses as t7','t7.id','t2.curse_id')
            ->groupBy('t1.first_name','t1.last_name','t1.id','t7.name','t2.id')
            ->orderBy('meses')
            ->get();

        $persons = Student::with('person','representant.person','payments.months')->get();

        return view('persons/defaulterperson',compact('persons','nm','months','students'));
    }

    public function createPerson()
    {
        $proffessions = Proffession::all();
        $curses = Curse::all();
        $representants = Representant::with('person')->get();

        return view('persons.createperson', compact('proffessions','representants','curses'));
    }
    public function storePerson(Request $request)
    {
        $this->validate($request, [
                'first_name' => 'required|min:2|max:100',
                'cedula' => 'required|min:7|max:8|unique:persons',    //Rule::unique('people'),
                'last_name' => 'required|min:3|max:50|',
                'phone' => 'required|min:11|max:12',
                'phone_home' => 'min:11|max:12',
                'email' => 'required|unique:persons',
                'address' => 'required|min:8max:60',
            ]
        );

        $person = new Person($request->except('proffession_id'));
        $person->save();

        if ($request->role == 'parent') {
            $id = $person->id;
            $representant = new Representant;
            $representant->proffession_id = $request->proffession_id;
            $representant->person_id = $id;
            $representant->save();
            $user = new User;
            $user->username= $request->cedula;
            $user->password= bcrypt($request->cedula);
            $user->person_id= $id;
            $user->role= "user";
            $user->save();
    }
        if ($request->role == 'student') {
            $id = $person->id;
            $student = new Student($request->only('representant_id','curse_id'));
            $student->person_id = $id;
            $student->curse_id = $request->curse_id;
            $student->save();
        }

        return redirect()->route('createPerson')->with('alert','Registro Almacenado Exitosamente');
    }

    public function EditPerson($id)
    {
        $representant = Representant::with('person')->findOrFail($id);
        $proffessions = Proffession::all();
        return view('persons/editperson', compact('representant','proffessions','curses'));
    }
    public function EditStudent($id)
    {
        $student = Student::with('person')->findOrFail($id);
        $curses = Curse::all();
        $representants = Representant::with('person')->get();
        return view('persons/editstudent', compact('student','curses','representants'));
    }

    public function updatePerson(Request $request)
    {
        $person = Person::findOrFail($request->person_id);

        $this->validate($request, [
                'first_name' => 'required|min:2|max:100',
                'cedula' => Rule::unique('persons')->ignore($person->id),
                'last_name' => 'required|min:3|max:50|',
                'phone' => 'required|min:11|max:15',
                'phone_home' => 'required',
                'email' => Rule::unique('persons')->ignore($person->id),
                'address' => 'required',
            ]
        );

        $person->update($request->except('proffession_id'));

        $representant = Representant::findOrFail($request->representant_id);
        $representant->proffession_id = $request->proffession_id;
        $representant->person_id = $request->person_id;
        $representant->save();

        return redirect()->route('indexPerson')->with('alert','Datos Actualizados');

    }
    public function updateStudent(Request $request)
    {
        $person = Person::findOrFail($request->person_id);

        $this->validate($request, [
                'first_name' => 'required|min:2|max:100',
                'cedula' => Rule::unique('persons')->ignore($person->id),
                'last_name' => 'required|min:3|max:50|',
                'phone' => 'required|min:11|max:18',
                'phone_home' => 'required',
                'email' => Rule::unique('persons')->ignore($person->id),
                'address' => 'required',
            ]
        );

        $person->update($request->except('curse_id'));

        $student = Student::findOrFail($request->student_id);
        $student->curse_id = $request->curse_id;
        $student->person_id = $request->person_id;
        $student->representant_id = $request->representant_id;
        $student->save();

        return view('home')->with('alert','Datos Actualizados');

    }

    public function destroyStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('indexPerson')->with('alert','Estudiante retirado satisfactoriamente');
    }

    public function mail($id)
    {
        $user = User::find($id);

        Mail::to($user->person->email, $user->person->fullName)
            ->send(new Welcome($user));

        return back();
    }
}
