<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\ProductFilter;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    protected  $product, $filter , $produtcInterface;


    public function __construct(Product $product, ProductFilter $filter , ProductRepositoryInterface $produtcInterface)
    {
        $this->product = $product;
        $this->filter = $filter;
        $this->produtcInterface = $produtcInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{

            $limit = $request->limit ?? 10;
            $orderBy = $request->orderBy ?? 'updated_at';
            $sortBy = $request->sortBy ?? 'desc';
            
            $products = $this->product
                        ->filter($this->filter)
                        ->orderBy($orderBy, $sortBy)
                        ->paginate($limit);

            if($products->isEmpty()) {
                return $this->respondWithNotFound('No products found');
            }

            return $this->dataResponse($products);

        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong', self::HTTP_INTERNAL_SERVER_ERROR , $e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            //
        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong' , $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            //
        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong' , $e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            //
        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong' , $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            //
        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong' , $e);
        }
    }
}
