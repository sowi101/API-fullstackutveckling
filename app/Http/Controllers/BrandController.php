<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return all data from the table brands
        return Brand::all();
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

        // Saves data to a row in table brands
        return Brand::create($request->all());
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
        $brand = Brand::find($id);

        // If statement that checks if row exists in table brands
        if ($brand != null) {
            // Return the variable with data
            return $brand;
        } else {
            // Return error message as JSON and status code
            return response()->json([
                "Märke finns inte lagrad."
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
        $brand = Brand::find($id);

        // If statement that checks if row exists in table brands
        if ($brand != null) {
            // Call of method that validates input
            $request->validate([
                'name' => 'required',
            ]);

            // Call of method to update row
            $brand->update($request->all());

            // Return the variable with updated data
            return $brand;
        } else {
            // Return error message as JSON and status code
            return response()->json([
                "Märke finns inte lagrad."
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
        $brand = Brand::find($id);

        // If statement that checks if row exists in table brands
        if ($brand != null) {
            // Call of method to delete row
            $brand->delete();

            // Return success message as JSON
            return response()->json([
                'Märket är raderad.'
            ]);
        } else {
            // Return error message as JSON and status code
            return response()->json([
                "Märke finns inte lagrad."
            ], 404);
        }
    }

    // Method that get all products that belong to a certain brand
    public function getProductsByBrand($id)
    {
        // Saves a certain row to a variable
        $brand = Brand::find($id);

        // If statement that checks if row doesn't exists in table brands
        if ($brand == null) {
            // Return error message as JSON and status code
            return response()->json([
                'Märke finns inte lagrad'
            ], 404);
        }

        // Save all products that belongs to the brand to a variable
        $products = Brand::find($id)->products;

        // Return the variable with data
        return $products;
    }
}
