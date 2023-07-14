<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_code',
    ];


    function ads()
    {
        return $this->hasMany(Ad::class);
    }

    function city()
    {
        return $this->hasMany(State::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}