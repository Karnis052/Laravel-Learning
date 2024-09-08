<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Consumer;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
       // dd("check");
        try {
            $validateData = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $consumer = Consumer::where('email', $validateData['email'])->first();
            if($consumer && Hash::check($validateData['password'], $consumer->password)){
                $token = $consumer->createToken('authToken')->plainTextToken;
                return response()->json([
                    'message' => 'Login successful',
                    'token' => $token,
                    'user' => $consumer
                ], 200);
            }else
            {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
            
            
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred during login', 'error' => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Revoke the token that was used to authenticate the current request
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred during logout', 'error' => $e->getMessage()], 500);
        }
    }
}
