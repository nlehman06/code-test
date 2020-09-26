<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $newProduct = Product::create($data);
        return response()->json($newProduct);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $product->update($data);
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([]);
    }

    public function upload(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image'
        ]);
        $path = $request->file('image')->store('images', 'public');
        $product->image = $path;
        $product->update();
        return response()->json($product);
    }
}
