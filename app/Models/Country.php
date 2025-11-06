<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'code'];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
