<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dateinscription extends Model
{
    protected $fillable = [
      'name',
    ];
    protected $table = 'dateinscription';
}
