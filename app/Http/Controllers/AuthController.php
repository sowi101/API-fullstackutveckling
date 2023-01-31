<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facedes\Hash;

class AuthController extends Controller
{
    // Method to registrate user
    public function register(Request $request)
    {

        // Call of method that validates input of all attributes in the array and saves it to a variable
        $validationOfUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email', // Validation of an unique and correct email 
                'password' => 'required'
            ]
        );

        // If statement that check if validation failed
        if ($validationOfUser->fails()) {
            // Return error message and list of errors as JSON and status code
            return response()->json([
                'message' => 'Valideringsfel',
                'error' => $validationOfUser->errors()
            ], 401);
        }

        // Saves all data to a row in table users
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']) // Password gets hashed
        ]);

        // Creates a token
        $token = $user->createToken('APITOKEN')->plainTextToken;

        // Saves an array with message, user data and token to a variable
        $response = [
            'message' => 'Användare skapad',
            'user' => $user,
            'token' => $token
        ];

        // Return variable and a status code
        return response($response, 201);
    }

    // Method to login user
    public function login(Request $request)
    {
        // Call of method that validates input of all attributes in the array and saves it to a variable
        $validationOfUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        // If statement that check if validation failed
        if ($validationOfUser->fails()) {
            return response()->json([
                'message' => 'Valideringsfel',
                'error' => $validationOfUser->errors()
            ], 401);
        }

        // If statement that call a method that verifies if email and password is correct and check if the verification fails 
        if (!auth()->attempt($request->only('email', 'password'))) {
            // Return error message as JSON and status code
            return response()->json([
                'message' => 'Inkorrekt email eller lösenord'
            ], 401);
        }

        // Saves data about the user to a variable
        $user = User::where('email', $request->email)->first();

        // Return an array as JSON with success message, a created token and status code
        return response()->json([
            'message' => 'Användare inloggad',
            'token' => $user->createToken('APITOKEN')->plainTextToken
        ], 200);
    }

    // Method to log out user
    public function logout(Request $request)
    {
        // Delete token for the user that is logged in
        $request->user()->currentAccessToken()->delete();

        // Saves an array with a message to a variable
        $response = [
            'message' => 'Användare utloggad'
        ];

        // Return variable and status code
        return response($response, 200);
    }
}
