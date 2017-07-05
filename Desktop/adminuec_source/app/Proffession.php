<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proffession extends Model
{
    protected $fillable = [
        'name'
    ];
    public function representants()
    {
        return $this->hasMany(Representant::class);
    }
}
