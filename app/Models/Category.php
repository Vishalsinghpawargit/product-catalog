<?php

namespace App\Models;

use App\Traits\RecursiveModel;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use RecursiveModel;

    protected $guarded = ['id'];

    protected $fillable = ['name', 'parent_id'];

}
