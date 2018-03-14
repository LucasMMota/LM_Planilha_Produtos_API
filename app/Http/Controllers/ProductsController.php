<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {

        return $product;
//        $return = ['error' => 'Product not Found'];
//        $status = 200;
//
//        $product = Product::find($lm);
//        if ($product) {
//            $return = $product;
//            $status = 200;
//        }
//
//        return response()->json($return, $status);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function delete(Product $product)
    {
        if ($product->delete())
            return response()->json(['success' => 'Product deleted'], 200);

        return response()->json(['success' => 'Product not found'], 404);
    }
}
