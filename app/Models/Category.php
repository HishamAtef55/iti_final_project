<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'max_number_free_ads',
        'free_ads_days'
    ];


    public function parent()
    {
        return $this->belongsTo(self::class, 'category_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'category_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\Attribute', 'category_id');
    }

   /* function ads()
    {
        return $this->hasMany(Ad::class);
    }*/

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'category_package');

    }


    public function ads()
    {
        return $this->hasMany(Ad::class, 'category_id');
    }
}

