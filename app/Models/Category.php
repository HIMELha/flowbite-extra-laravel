<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image'];

}
