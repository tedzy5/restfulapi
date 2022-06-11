<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        return response()->json(Product::all(), 200);
    }

    public function show($id) {
        $product = Product::find($id);
        if(is_null($product)) {
            return response()->json(['message' => 'Oops! Product not found.'], 404);
        } else {
            return response()->json(Product::find($id), 200);
        }
    }

    public function search($name) {
        $product = Product::where('name', 'LIKE', '%'.$name.'%')->get();

        if(is_null($product)) {
            return response()->json(['message' => 'Oops, you cannot search for everything!']);
        } else {
            return response()->json($product, 200);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:2|max:20',
            'description' => 'min:10',
            'price' => 'required|numeric'
        ]);

        $products = Product::create($request->all());
        return response($products, 201);

    }

    public function update(Request $request, $id) {
        $products = Product::find($id);

        if(is_null($products)) {
            return response()->json(['message' => 'Oops! Product is not found!'], 404);
        } else {
            $request->validate([
                'name' => 'required|min:2|max:20',
                'description' => 'min:10',
                'price' => 'required|numeric'
            ]);

            $products->update($request->all());
            return response($request, 200);
        }
    }

    public function destroy(Request $request, $id) {
        $product = Product::find($id);
        if(is_null($product)) {
            return response()->json(['message' => 'Oops, product is not found!']);
        } else {
            $product->delete();
            return response()->json(['message' => 'Product successfully deleted.'], 204);
        }
    }
}
