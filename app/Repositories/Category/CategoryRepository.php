<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Models\User;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::select('id', 'parent_id', 'name')->with('parent:id,name')->get();
    }

    public function find($slug)
    {
        return Category::findBySlug($slug);
    }

    public function create($data)
    {
        return Category::create($data);
    }

    public function update($data, $slug)
    {
        return Category::findBySlug($slug)->update($data);
    }

    public function delete($slug)
    {
        return Category::findBySlug($slug)->delete();
    }
}