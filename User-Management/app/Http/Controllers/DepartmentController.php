<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Validation\ValidationException;
class DepartmentController extends Controller
{
    public function index()
    {
        try{
            $department = Department::get();
            return response()->json($department);
        }catch(\Exception $e){
            return response()->json(['error' => 'An error occurred while fetching users.'], 500);
        }
    }
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name'=> 'required|string|unique:departments,name',
            ]);
            $department = Department::create([
                'name' => $validatedData['name'],
            ]);
            return response()->json([
                'message' => 'Department created successfully',
                'department' => $department['name']
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'validation failed',
                'error' => $e->errors(), 
            ], 422);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }
}
