<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
    protected $table = 'persons';

    protected $fillable = [
        'cedula','first_name','last_name','phone','email','phone_home','address','role'
    ];
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function representants()
    {
        return $this->hasMany(Representant::class);
    }

    public static function findByApi($term)
    {
        /*return static::select('id','first_name', 'last_name', 'email')
            ->where('first_name','LIKE', "%$term%")
            ->orWhere('last_name', 'LIKE', "%$term%")
            ->orwhere('email', 'LIKE', "%$term%")
            ->get();
        */

        return DB::table('persons as t1')
            ->join('representants as t2', 't1.id', '=', 't2.person_id')
            ->join('students as t3', 't3.representant_id', '=', 't2.id')
            ->join('persons as t4', 't4.id', '=', 't3.person_id')
            ->select('t1.first_name as papaname',
                't1.last_name as papaape',
                't4.first_name as hijoname',
                't4.last_name as hijoape',
                't4.id','t3.id as student')
            //->select(DB::raw('CONCAT(t4.first_name," ", t4.last_name) AS padre'))
            ->orderBy('papaname')
            ->get();

    }

    public function scopeSearchPerson($query, $person)
    {
        if (! trim($person) == "") {
            return DB::table('persons as t1')
                ->join('representants as t2', 't1.id', '=', 't2.person_id')
                ->join('students as t3', 't3.representant_id', '=', 't2.id')
                ->join('persons as t4', 't4.id', '=', 't3.person_id')
                ->select('t1.first_name as papaname',
                    't1.last_name as papaape',
                    't4.first_name as hijoname',
                    't4.last_name as hijoape',
                    't4.id','t3.id as student')
                //->select(DB::raw('CONCAT(t4.first_name," ", t4.last_name) AS padre'))
                    ->where('t1.first_name','like',"%$person%")
                    ->orWhere('t1.last_name','like',"%$person%")
                ->get();
        }
    }


}
