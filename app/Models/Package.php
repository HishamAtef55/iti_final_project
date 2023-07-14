<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'validity_days',
        'available',
        'num_of_ads',
        'price',
        'days',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withPivot('status','start_date','end_date');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('category_id','quantity','status','start_date','category_id');
    }
}
