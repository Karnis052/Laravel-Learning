<?php

namespace App\Http\Controllers;

use App\Models\Consumer;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchByName(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => 'required|string|min:2',
            ]);
            $users = Consumer::where('name', 'like', '%' . $validatedData['name'] . '%')
                    ->limit(10)
                    ->get(['username', 'name', 'email']);

            return response()->json([
                'data' => $users,
                'count' => $users->count() > 0? $users->count() :0,
                
            ], 200);
        }catch (ValidationException $e){
            return response()->json([
                'error' =>'Validation failed',
                'messages' =>$e->errors()
            ], 422);
        }catch (\Exception $e){
            return response()->json([
                'error' => 'An error occurred while searching for users',
            ] , 500);
        }
    }
}
