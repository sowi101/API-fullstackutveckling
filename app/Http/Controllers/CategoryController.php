<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return all data from the table categories
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Call of method that validates input
        $request->validate([
            'name' => 'required',
        ]);

        // Saves data to a row in table categories
        return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Saves a certain row to a variable
        $category = Category::find($id);

        // If statement that checks if row exists in table categories
        if ($category != null) {
            // Return the variable with data
            return $category;
        } else {
            // Return error message as JSON and status code
            return response()->json([
                "Kategori finns inte lagrad."
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Saves a certain row to a variable
        $category = Category::find($id);

        // If statement that checks if row exists in table categories
        if ($category != null) {
            // Call of method that validates input
            $request->validate([
                'name' => 'required',
            ]);

            // Call of method to update row
            $category->update($request->all());

            // Return the variable with updated data
            return $category;
        } else {
            // Return error message as JSON and status code
            return response()->json([
                "Kategori finns inte lagrad."
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Saves a certain row to a variable
        $category = Category::find($id);

        // If statement that checks if row exists in table categories
        if ($category != null) {
            // Call of method to delete row
            $category->delete();

            // Return success message as JSON
            return response()->json([
                'Kategorin är raderad.'
            ]);
        } else {
            // Return error message as JSON and status code
            return response()->json([
                "Kategorin finns inte lagrad."
            ], 404);
        }
    }

    // Method that get all products that belong to a certain category
    public function getProductsByCategory($id)
    {
        // Saves a certain row to a variable
        $category = Category::find($id);

        // If statement that checks if row doesn't exists in table categories
        if ($category == null) {
            return response()->json([
                'Kategori finns inte lagrad'
            ], 404);
        }

        // Save all products that belongs to the category to a variable
        $products = Category::find($id)->products;

        // Return the variable with data
        return $products;
    }
}
