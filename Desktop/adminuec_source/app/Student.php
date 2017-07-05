<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'representant_id', 'person_id', 'curse_id'
    ];
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    public function representant()
    {
        return $this->belongsTo(Representant::class);
    }
    public function curse()
    {
        return $this->belongsTo(Curse::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function hasMonth()
    {
        return $this->payments->months->count();
    }
}
