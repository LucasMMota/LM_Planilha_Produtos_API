<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSheet;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;

class ProductsController extends Controller
{

    public function index()
    {
        return response()->json(Product::all());
    }

    public function store()
    {
        $sheetPath = '/Users/t40722/Projetos/Laravel_API/products_teste_webdev_leroy.xlsx';
        $job = new ProcessSheet($sheetPath);
        $job->onQueue('lmNewsProductsJob');
        $this->dispatch($job);

        return response()->json(['status' => 'Queued to be processed']);

    }

    public function checkJobStatus()
    {
        $status = 'Failure';
        if (Queue::size('lmNewsProductsJob') === 0)
            $status = 'Success';
        return response()->json(['jobSatus' => 'Proccessed with ' . $status]);
    }

    public function show(Product $product)
    {

        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product);
    }

    public function delete(Product $product)
    {
        if ($product->delete())
            return response()->json(['success' => 'Product deleted']);

        return response()->json(['success' => 'Product not found'], 404);
    }
}
