<?php

namespace App\Models;

use App\Traits\RecursiveModel;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use RecursiveModel , HasSlug;

    protected $guarded = ['id'];

    protected $fillable = ['name', 'parent_id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


}
