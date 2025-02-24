<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\ProductFilter;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Prduct\StoreProductRequest;
use App\Http\Requests\V1\Prduct\UpdateProductRequest;
use App\Http\Resources\V1\Product\ProductDetailResource;
use App\Http\Resources\V1\Product\ProductListResource;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Traits\CacheHelper;
use Illuminate\Http\Request;

class ProductController extends ApiController
{

    use CacheHelper;

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

            $cacheKey = "products_{$limit}_{$orderBy}_{$sortBy}_" . md5(json_encode($request->all()));

            $products = $this->cacheData($cacheKey, 60 ,function () use ($request, $limit, $orderBy, $sortBy) {
                $query = $this->product->filter($this->filter);

                return $this->applyDynamicPagination(
                    (clone $query)
                    ->select('id', 'name', 'slug', 'price', 'description', 'category_id')
                    ->with('category:id,name')
                    ->filter($this->filter)
                    ->orderBy($orderBy, $sortBy),
                    $request,
                    true,
                    $limit
                );
            });

            if($products->isEmpty()) {
                return $this->respondWithNotFound('No products found');
            }

            return $this->paginatedDataResponse($products, ProductListResource::class);

            return $this->dataResponse(ProductListResource::collection($products));

        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong', self::HTTP_INTERNAL_SERVER_ERROR , $e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try{
            
            $data = $request->validated();

            $product = $this->produtcInterface->create($data);

            $this->clearCache('products');

            return $this->respondeWithSuccess($product, self::HTTP_CREATED);

        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong' , $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try{
            
            $product = $this->produtcInterface->find($slug);

            if(!$product) {
                return $this->respondWithNotFound('Product not found');
            }

            return $this->dataResponse(ProductDetailResource::make($product));

        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong' , self::HTTP_INTERNAL_SERVER_ERROR , $e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $slug)
    {
        try{
            
            $data = $request->validated();

            $product = $this->produtcInterface->find($slug);

            if(!$product) {
                return $this->respondWithNotFound('Product not found');
            }

            $product = $this->produtcInterface->update($data , $slug);

            $this->clearCache('products');

            return $this->respondeWithSuccess([
                'message' => 'product Update successfully!',
                'code' => self::HTTP_OK,
            ], self::HTTP_OK);

        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong' , $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try{
            
            $product = $this->produtcInterface->find($slug);

            if(!$product) {
                return $this->respondWithNotFound('Product not found');
            }

            $this->produtcInterface->delete($slug);

            $this->clearCache('products');

            return $this->respondeWithSuccess([
                'message' => 'product deleted successfully!',
                'code' => self::HTTP_OK,
            ], self::HTTP_OK);


        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong' , $e);
        }
    }
}
