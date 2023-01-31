<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gets all products from the database and save it to a variable
        $products = Product::all();

        // For each loop in which category name and brand name is added to every row of products from table categories and brands
        foreach ($products as $product) {
            $category = Category::find($product->category_id);
            $product->category_name = $category->name;
            $brand = Brand::find($product->brand_id);
            $product->brand_name = $brand->name;
        }

        // Return variable with data
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Call of method that validates input to all attributes in the array
        $request->validate([
            'article' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'amount' => 'required'
        ]);

        // Create a row in table products with all data from the request
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Saves a certain row of data to a variable
        $product = Product::find($id);

        // If statement that checks if row exists in table products
        if ($product != null) {
            // Category name and brand name is added from table categories and brands to the rest av the data.
            $category = Category::find($product->category_id);
            $product->category_name = $category->name;
            $brand = Brand::find($product->brand_id);
            $product->brand_name = $brand->name;

            // Return the variable with data
            return $product;
        } else {
            // Return error message as JSON and status code
            return response()->json([
                "Produkt finns inte lagrad."
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
        $product = Product::find($id);

        // If statement that checks if row exists in table products
        if ($product != null) {
            // Call of method that validates input to all attributes in the array
            $request->validate([
                'article' => 'required',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'brand_id' => 'required',
                'amount' => 'required'
            ]);

            // Call of method to update row
            $product->update($request->all());
            
            // Return the variable with updated data
            return $product;
        } else {
            // Return error message as JSON and status code
            return response()->json([
                "Produkt finns inte lagrad."
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
        $product = Product::find($id);

        // If statement that checks if row exists in table products
        if ($product != null) {
            // Call of method to delete row
            $product->delete();
            // Return success message as JSON
            return response()->json([
                'Produkten är raderad.'
            ]);
        } else {
            // Return error message as JSON and status code
            return response()->json([
                "Produkt finns inte lagrad."
            ], 404);
        }
    }
}
