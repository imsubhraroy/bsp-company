<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name'];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
