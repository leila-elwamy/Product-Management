<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{



    public function index()
    {
        $products = Product::paginate(2);
        return Inertia::render('Dashboard', compact('products'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'size' => 'required',
        ]);

        $product = Product::create($validatedData);

        return Inertia::location(route('dashboard'));
    }



    public function create()
    {
        return Inertia::render('Admin/ProductForm');

    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'size' => 'required|string',
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->size = $request->input('size');
        $product->save();


        return Inertia::location(route('dashboard'));
    }



    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return Inertia::render('Admin/editProduct', ['product' => $product]);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }


    // public function filter(Request $request)
    // {
    //     $name = $request->input('name');
    //     $size = $request->input('size');
    //     $description = $request->input('description');

    //     $query = Product::query();

    //     if ($name) {
    //         $query->where('name', 'like', '%' . $name . '%');
    //     }

    //     if ($size) {
    //         $query->where('size', 'like', '%' . $size . '%');
    //     }

    //     if ($description) {
    //         $query->where('description', 'like', '%' . $description . '%');
    //     }

    //     $filteredProducts = $query->get();

    //     return response()->json($filteredProducts);
    // }



    public function filter(Request $request)
    {
        $name = $request->input('name');
        $size = $request->input('size');
        $description = $request->input('description');

        $query = Product::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($size) {
            $query->where('size', 'like', '%' . $size . '%');
        }

        if ($description) {
            $query->where('description', 'like', '%' . $description . '%');
        }

        $filteredProducts = $query->get();

        return response()->json($filteredProducts);
    }

}