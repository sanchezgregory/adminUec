<?php

namespace App\Http\Controllers;

use App\Curse;
use App\Inscription;
use App\Mail\PaymentMail;
use App\Month;
use App\Payment;
use App\Period;
use App\Person;
use App\Student;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
Use Mail;
use Yajra\Datatables\Facades\Datatables;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('student.person','months','inscriptions')->orderBy('id','Desc')->paginate(10);
        return view('payment/indexpayment',compact('payments'));
    }

    public function create(Request $request, $id)
    {
        $now = Carbon::now();

        if ($request->idhijo) $id = $request->idhijo;
        $title = "Modulo de inscripcion";
        $months = DB::table('months')
                    ->select('months.id as id','months.name as month', 'periods.name as period', 'costs.name as cost')
                    ->join('periods', 'months.period_id','periods.id')
                    ->join('costs', 'months.cost_id','costs.id')
                    ->whereNotIn('months.id', function($query) use($id)
                    {
                       $query->select('months.id')
                           ->from('persons')
                           ->join('students', 'students.person_id','persons.id')
                           ->join('payments', 'payments.student_id','students.id')
                           ->join('month_payment', 'month_payment.payment_id', 'payments.id')
                           ->join('months', 'months.id', 'month_payment.month_id')
                           ->join('periods','periods.id','months.period_id')
                            ->where('students.id', $id);
                    })
                    ->limit(3)
                    ->get();

        $idmax = Student::select('curse_id')->where('id',$id)->get();

        $curses = Curse::select('id','name')
            ->where('id','>',$idmax->last()->curse_id)->limit(1)->get();

        $period = Period::where('active',true)->first();
        $student = Student::with('person','representant.person','payments.months')->findOrFail($id);
        $costInsc = DB::table('inscription_costs')
            ->select('name')
            ->max('name');

        return view('payment/createpayment', compact('costInsc','title','months','now','student' ,'id','period','curses'));
    }

    public function storePayment(Request $request)
    {
        /*
        $this->validate($request, [
            'month_id' => Rule::exists('month_payment')
            ->join('payment','')
        ]);
        */

        $pago = Payment::create($request->all());
        $payment = Payment::select('id')->where('student_id',$pago->student_id)->latest()->first();

        $student = Student::findOrFail($pago->student_id);


        $payment->months()->sync($request->months);

        $costo_total = 0;

        foreach ($payment->months as $month) {
            $costo_total += $month->cost->name;
        }

        $payment->update([
            'total' => $costo_total
        ]);

        Mail::to($pago->student->person->email, $pago->student->person->fullName)
            ->send(new PaymentMail($payment));

        return redirect()->route('indexpayment')->with('alert','Pago de mensualidad registrado');
    }

    public function storePayment2(Request $request)
    {

        $pago = new Payment;
        $pago->student_id = $request->student_id;
        $pago->total = $request->total;
        $pago->save();

        $id = $request->student_id;
        $id = Payment::select('id')->where('student_id',$id)->get();
        $id = $id->last();

        $student = Student::find($request->student_id);
        $student->curse_id = $request->curse_id;
        $student->save();

        $insc = new Inscription;
        $insc->payment_id = $id->id;
        $insc->period_id = $request->period_id;
        $insc->curse_id = $request->curse_id;
        $insc->save();


        $payments = Payment::orderBy('id','Desc')->paginate(10);
        return view('payment/indexpayment',compact('payments'))->with('alert','Pago de inscripcion registrado');

    }

    public function dataPayment($id)
    {
        //$student = Student::with('payments','person','representant.person','payments.months')->where('id',$id);
        $payments = Payment::with('months')->where('student_id',$id);
        return Datatables::of($payments)
            ->addColumn('months', function (Payment $payment) {
                    $response = "";
                    foreach($payment->months as $month) {
                        $response = $response . ", " .$month->name;
                    }
                    str_replace_first(' ', '', $response);
                    return str_replace_first(',', '', $response);
            })->make(true);
    }
}
