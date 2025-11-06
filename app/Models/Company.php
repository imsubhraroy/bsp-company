<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'logo',
        'name',
        'email',
        'mobile',
        'country_id',
        'state_id',
        'city_id',
    ];

    protected $with = ['country', 'state', 'city'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }

    protected static function booted()
    {
        static::deleting(function ($company) {
            if ($company->logo) {
                Storage::delete($company->logo);
            }
        });
    }
}
