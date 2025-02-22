<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface 
{

    public function all()
    {
        return Product::all();
    }

    public function find($slug)
    {
        return Product::findBySlug($slug);
    }

    public function create($data)
    {
        return Product::create($data);
    }

    public function update($data, $slug)
    {
        return Product::findBySlug($slug)->update($data);
    }

    public function delete($slug)
    {
        return Product::findBySlug($slug)->delete();
    }
}