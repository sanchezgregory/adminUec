<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representant extends Model
{
    protected $fillable = [
        'profession_id', 'person_id'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    public function proffession()
    {
        return $this->belongsTo(Proffession::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function hasStudent()
    {
        return count($this->students);
    }
}
