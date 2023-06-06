<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades;
use Illuminate\Validation\Validator;

class ProductController extends Controller
{
    /**
     * method for find all
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {

        $product = Product::all();
        try {
            return response()->json($product, 200, ["Content-Type" => "application/json"]);
        } catch (QueryException $queryException) {
            return response()->json([], 500, ["Content-Type" => "application/json"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * method for create
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Facades\Validator::make(
            $request->all(),
            [
                'category_id' => 'required|Numeric',
                'name' => 'required|string|min:3|max:50',
                'price' => 'required|Numeric'
            ],
            [
                "numeric" => "The :attribute field must be a number"
            ]
        );


        if ($validator->fails()) {
            return response()->json(
                ["status" => false, "messages" => $validator->errors(), "payload" => null],
                400,
                ["Content-Type" => "application/json"]
            );
        } else {
            $product = Product::create($request->all());
            return response()->json(
                ["status" => true, "messages" => [], "payload" => $request->only(['name', 'price'])],
                200,
                ["Content-Type" => "application/json"]
            );
        }
    }

    /**
     * method for find by identity value
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $product = Product::find($id);
        return response()->json($product, 200, ["Content-Type" => "application/json"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * method for update
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $product = Product::find($id);
        $product->name = $request->input("name");
        $product->price = $request->input("price");
        $product->save();
        return response()->json(["status" => true, "messages" => [], "payload" => $request->only(['name', 'price'])], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * method for delete
     * Remove the specified resource from storage.
     */
    public function destroy($id): void
    {
        $product = Product::find($id);
        $product->delete();
    }
}
