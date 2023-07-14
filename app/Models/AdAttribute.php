<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdAttribute extends Model
{
    use HasFactory;
    protected $table = 'ad_attribute';

    protected $fillable = ['ad_id', 'attribute_id', 'value'];
}