<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id', 'total'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function months()
    {
        return $this->belongsToMany(Month::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

}
