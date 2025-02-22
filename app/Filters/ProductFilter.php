<?php

namespace App\Filters;

use Carbon\Carbon;
use Kblais\QueryFilter\QueryFilter;

class ProductFilter extends QueryFilter
{
    public function name($name)
    {
        return $this->builder->where('name', 'like', "%$name%");
    }

    public function sku($sku)
    {
        return $this->builder->where('sku', 'like', "%$sku%");
    }

    public function price($price)
    {
        return $this->builder->where('price', $price);
    }

    public function categoryId($categoryId)
    {
        return $this->builder->where('category_id', $categoryId);
    }

    public function categoryName($categoryName)
    {
        return $this->builder->whereHas('category', function ($query) use ($categoryName) {
            $query->where('name','like', "%$categoryName%");
        });
    }
}