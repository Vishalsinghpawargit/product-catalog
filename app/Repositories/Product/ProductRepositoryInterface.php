<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function all();
    public function find($slug);
    public function create($data);
    public function update($data, $slug);
    public function delete($slug);
}