<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Models\User;
use CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::with('parent:id,name')->get();
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function create($data)
    {
        return Category::create($data);
    }

    public function update($data, $id)
    {
        return Category::find($id)->update($data);
    }

    public function delete($id)
    {
        return Category::find($id)->delete();
    }
}