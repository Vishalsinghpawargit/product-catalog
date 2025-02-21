<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function all();
    public function find($id);
    public function create($data);
    public function update($data, $id);
    public function delete($id);
}