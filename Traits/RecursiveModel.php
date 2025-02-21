<?php

namespace App\Traits;

trait RecursiveModel
{
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    // Recursive ancestors relationship
    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

}