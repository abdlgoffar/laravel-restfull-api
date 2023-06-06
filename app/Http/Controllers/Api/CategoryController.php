<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * method for find all
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $category = Category::all();
        try {
            return response()->json($category, 200, ["Content-Type" => "application/json"]);
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
        $product = Category::create($request->all());
        return response()->json(["status" => true, "messages" => [], "payload" => $request->only(['name'])], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
