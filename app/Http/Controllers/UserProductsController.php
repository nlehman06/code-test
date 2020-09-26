<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserProductsController extends Controller
{
    public function index()
    {
        $productList = auth()->user()->products;
        return response()->json($productList->toArray());
    }

    public function store(Request $request)
    {
        Gate::authorize('add-products');
        $data = $request->validate([
            'productId' => 'required|exists:products,id'
        ]);
        $request->user()->products()->attach($data['productId']);
        return response()->json($request->user()->products);
    }

    public function destroy(Request $request)
    {
        $request->user()->products()->detach($request->productId);
        return response()->json($request->user()->products);
    }
}
