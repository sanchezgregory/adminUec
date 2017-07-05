<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
        'name','active'
    ];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function months()
    {
        return $this->hasMany(Month::class);
    }

    public static function NewPeriod()
    {
        $now = Carbon::now();
        $actualperiod = Period::find(1);

        if ($now > $actualperiod->name){
            $year = Carbon::now()->year;
            $np = $year.'-'.($year+1);

            if(! Period::where('name',$np)->first() ) {

                Period::where('active', '1')->update(array('active' => 0)); // hacemos false todos los periodos

                // agregamos el nuevo periodo
                $period = new Period;
                $period->name = $np;
                $period->active = true;
                $period->save();

                // Obtenemos los id maximos de periodo y cost para agragarlos los nuevos meses
                $period = Period::max('id');
                $cost = Cost::max('id');

                // agregamos los meses de Septiembre que es cuando empieza el periodo escolar
                // -1-
                $month = new Month;
                $month->name = 'Septiembre';
                $month->nm = 1;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -2-
                $month = new Month;
                $month->name = 'Octubre';
                $month->nm = 2;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -3-
                $month = new Month;
                $month->name = 'Noviembre';
                $month->nm = 3;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -4-
                $month = new Month;
                $month->name = 'Diciembre';
                $month->nm = 4;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -5-
                $month = new Month;
                $month->name = 'Enero';
                $month->nm = 5;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -6-
                $month = new Month;
                $month->name = 'Febrero';
                $month->nm = 6;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -7-
                $month = new Month;
                $month->name = 'Marzo';
                $month->nm = 7;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -8-
                $month = new Month;
                $month->name = 'Abril';
                $month->nm = 8;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -1-
                $month = new Month;
                $month->name = 'Mayo';
                $month->nm = 9;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -1-
                $month = new Month;
                $month->name = 'Junio';
                $month->nm = 10;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();
                // -1-
                $month = new Month;
                $month->name = 'Julio';
                $month->nm = 11;
                $month->period_id = $period;
                $month->cost_id = $cost;
                $month->save();

                return true;
            }

        }
        return false;
    }
}

