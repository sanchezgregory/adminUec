<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
      'payment_id', 'period_id', 'curse_id'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function curses()
    {
        return $this->belongsTo(Curse::class);
    }

    public function periods()
    {
        return $this->belongsTo(Period::class);
    }

    public function inscriptioncost()
    {
        return $this->belongsTo(InscriptionCost::class, 'inscriptioncost_id');
    }
}
