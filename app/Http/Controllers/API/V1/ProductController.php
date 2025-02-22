<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    protected  $product, $filter;


    public function __construct(ProductRepositoryInterface $product,  $filter)
    {
        $this->product = $product;
        $this->filter = $filter;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            //
        } catch (\Exception $e) {
            return $this->respondeWithError('something went wrong' , $e);
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
