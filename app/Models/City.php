<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_id',
        'name',
        'county',
        'latitude',
        'longitude'
    ];

    public function country()
    {
        return $this->belongsTo(State::class);
    }


    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}