<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Month extends Model
{
    protected $fillable = [
        'name','nm', 'period_id','cost_id'
    ];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }
    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }

    public static function findByApi($term)
    {
        return DB::table('months')
            ->join('periods', 'months.period_id','periods.id')
            -> select('months.name as month','periods.name as period')
            ->get();
    }
}
