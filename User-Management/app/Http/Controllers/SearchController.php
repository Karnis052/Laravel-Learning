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
                    ->with('department:id,name')
                    ->limit(10)
                    ->get(['id', 'username', 'name', 'email', 'department_id']);

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


// public function searchByName(Request $request)
// {
//     try {
//         $validatedData = $request->validate([
//             'name' => 'required|string|min:2',
//         ]);

//         $users = Consumer::where('name', 'like', '%' . $validatedData['name'] . '%')
//             ->with('department:id,name') // Eager load the department
//             ->limit(10)
//             ->get(['id', 'username', 'name', 'email', 'department_id']);

//         $formattedUsers = $users->map(function ($user) {
//             return [
//                 'id' => $user->id,
//                 'username' => $user->username,
//                 'name' => $user->name,
//                 'email' => $user->email,
//                 'department' => $user->department ? $user->department->name : 'No Department'
//             ];
//         });

//         return response()->json([
//             'data' => $formattedUsers,
//             'count' => $users->count(),
//         ], 200);
//     } catch (ValidationException $e) {
//         return response()->json([
//             'error' => 'Validation failed',
//             'messages' => $e->errors()
//         ], 422);
//     } catch (\Exception $e) {
//         return response()->json([
//             'error' => 'An error occurred while searching for users',
//         ], 500);
//     }
// }