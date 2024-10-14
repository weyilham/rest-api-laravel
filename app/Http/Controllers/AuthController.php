<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
   public function registration(Request $request) {


      $validate = Validator::make($request->all(), [
         'name' => 'required',
         'email' => 'required|email|unique:users',
         'password' => 'required|min:6'
      ]);

      if ($validate->fails()) {
         return response()->json([
            'status' => false,
            'statusCode' => 422,
            'message' => 'Validation error',
            'errors' => $validate->errors()
         ], 422);
      }

      

      User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => bcrypt($request->password)
      ]);

      return response()->json([
        'status' => true,
        'statusCode' => 200,
        'message' => 'User created successfully',
     ], 200);
   }


   public function login(Request $request) {
      $validate = Validator::make($request->all(), [
         'email' => 'required|email',
         'password' => 'required'
      ]);

      if ($validate->fails()) {
         return response()->json([
            'status' => false,
            'statusCode' => 422,
            'message' => 'Validation error',
            'errors' => $validate->errors()
         ], 422);
      }

      if (!auth()->attempt($request->only('email', 'password'))) {
         return response()->json([
            'status' => false,
            'statusCode' => 401,
            'message' => 'Email or password is incorrect',
         ], 401);
      }

      $user = User::where('email', $request['email'])->firstOrFail();
      
      $token = $user->createToken('auth_token')->plainTextToken;

      return response()->json([
         'status' => true,
         'statusCode' => 200,
         'message' => 'User logged in successfully',
         'access_token' => $token,
         'token_type' => 'Bearer',
      ], 200);
   }
}
