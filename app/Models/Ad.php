<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id', 'category_id', 'price', 'status', 'start_date', 'end_date', 'description', 'city_id', 'country_id', 'state_id', 'location' , 'remaining'];

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(state::class);
    }

    public function category()
    {

        return $this->belongsTo(Category::class);
    }


    public function attributes()


    {
        return $this->belongsToMany(Attribute::class)->withPivot('value');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
