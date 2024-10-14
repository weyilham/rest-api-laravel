<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::orderBy('id', 'desc')->get();
        return response()->json(
            [
                'status' => true,
                'statusCode' => 200,
                'message' => 'Get all products successfully',
                'data' => $products
            ]
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'statusCode' => 422,
                'message' => 'Validation error',
                'errors' => $validate->errors()
            ], 422);
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
        return response()->json(
            [
                'status' => true,
                'statusCode' => 200,
                'message' => 'Product created successfully',
            ], 200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
