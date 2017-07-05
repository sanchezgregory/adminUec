<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Cost extends Model
{
    use ValidatesRequests;

    protected $fillable = [
        'name'
    ];

    public function rules()
    {
        return [
            'name' => ['required','numeric','min:5','max:6']
        ];
    }

    public function months()
    {
        return $this->hasMany(Month::class);
    }
}
