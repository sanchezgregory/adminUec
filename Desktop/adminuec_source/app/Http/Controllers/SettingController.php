<?php

namespace App\Http\Controllers;

use App\Cost;
use App\dateinscription;
use App\Inscription;
use App\InscriptionCost;
use App\Month;
use App\Period;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function indexSetting()
    {

        $costs = Cost::orderBy('id','desc')->paginate(3);
        $inscs = InscriptionCost::orderBy('id','desc')->paginate(3);
        $dateinsc = dateinscription::orderBy('id','desc')->first();
        $period = Period::find(DB::table('periods')->max('id'));

        return view('settings/conf', compact('period','costs','inscs','dateinsc'));
    }

    public function StoreSettingCost(Request $request)
    {
        $this->validate($request , [
            'costmonth' => 'required|min:5|max:5'
        ]);

        $cost = new Cost();
        $cost->name = $request->costmonth;
        $cost->save();

        // -----DESDE AQUI SE ACTUALIZAN LOS COSTOS DE LOS MESES RESTANTES
        // ---- OBTENIENDO PARA ESO ID DEL PRIMER MES HASTA EL ID DEL ULTIMO Y EL ID DEL ULTIMO COSTO.
        // ---- A PARTIR DEL MES SELECCIONADO  EN $nm, EL PERIODO ULTIMO, Y EL COSTO ULTIMO

        $nm = Carbon::now()->month + 4;
        $period = Period::max('id');
        $lastmonth = Month::max('id');
        $cost = Cost::max('id');

        $month = Month::select('id','name')
            ->where('nm',$nm)
            ->where('period_id',$period)
            ->first();
        if (($month->name != 'Junio')or($month->name != 'Julio')) {
            for($i=$month->id; $i<=$lastmonth; $i++){
                $month = Month::find($i);
                $month->cost_id = $cost;
                $month->update();
            }
        }

        return redirect()->back()->with('alert','Registro De Mensualidad Realizado Con Exitoso');
    }

    public function StoreSettingInsc(Request $request)
    {
        $ins = new InscriptionCost();
        $this->validate ($request, [
            'insc_cost' => 'required|numeric'
        ]);
        $ins->name = $request->insc_cost;
        $ins->save();
        return redirect()->back()->with('alert','Agregado con exito, nuevo costo de inscripciones');
    }

    public function StoreSettingPeriod()
    {
        if (Period::NewPeriod())
            return redirect()->back()->with('alert','Nuevo perdiodo activado');
        else return redirect()->back()->with('alert', 'En este momento no se puede activar un nuevo periodo');
    }

    public function UpdateSettingDate(Request $request)
    {
        $now = Carbon::now()->format('d-m-Y');

        $fecha = $request->date;
        if ($request->date < $now) return redirect()->back()->with('alert','La fecha no puede ser menor a la actual');
        else {
            $this->validate($request, [
                'date' => 'required|date'
            ]);

            $date = dateinscription::find(1);
            $date->name = $request->date;
            $date->save();

            return redirect()->back()->with('alert', 'Nueva fecha de inscriciones agregada');
        }

    }
}
