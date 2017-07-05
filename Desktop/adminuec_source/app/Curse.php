<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curse extends Model
{
    protected $fillable = [
      'name'
    ];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
