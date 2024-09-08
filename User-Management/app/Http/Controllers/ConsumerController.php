<?php

namespace App\Http\Controllers;
use App\Models\Consumer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ConsumerController extends Controller
{
    public function index()
    {
        try {
            $users = Consumer::get();
            return response()->json($users, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching users.'], 500);
        }
    }

    public function getOneUser($id)
    {
        try {
            $user = Consumer::findOrFail($id);
            return response()->json(['data' => $user], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        } catch (\Exception $e) {
          
            return response()->json([
                'error' => 'An error occurred while fetching the user'
            ], 500);
        }
    }

    public function createUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'username' => 'required|string|max:255|unique:consumers,username',
                'password' => 'required|string|min:4',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:consumers,email',
                'department_id' => 'sometimes'
            ]);

            $user = Consumer::create([
                'username' => $validatedData['username'],
                'password' => bcrypt($validatedData['password']),
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'department_id' => $validatedData['department_id'],
            ]);
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user->only(['id', 'username', 'name', 'email'])
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error creating user', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|exists:consumers,id',
            ]);

            $user = Consumer::findOrFail($validatedData['id']);
            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the user'], 500);
        }
    }
    
}

