<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Products::where('jumlah_product','>',0)->get();

        if($products->isEmpty()){
            return response([
                'message' => 'Product is empty',
            ], 403);
        }

        return response([
            'products' => $products,
        ], 200);
    }

    public function product_detail($id){
        $products = Products::findOrFail($id);
        
        return response([
            'products' => $products,
        ], 200);
    }
}
