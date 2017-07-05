<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscriptionCost extends Model
{
    protected $fillable = [
      'name'
    ];
    protected $table = 'inscription_costs';

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}
