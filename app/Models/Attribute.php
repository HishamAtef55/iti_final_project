<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    protected $fillable = [
        'name',
        'category_id',
        'created_at',
        'updated_at'
    ];


    public function ads()
    {

        return $this->belongsToMany(Ad::class);
    }
}