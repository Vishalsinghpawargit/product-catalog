<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\ApiController;
use CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $cateogryRepository)
    {
        $this->categoryRepository = $cateogryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $categories = $this->categoryRepository->all();

            if($categories->isEmpty()) {
                return $this->respondWithNotFound('No categories found');
            }

            return $this->respondeWithSuccess($categories);
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
