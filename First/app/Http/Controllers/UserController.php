<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User:: with('posts')->get();
        $res = [
            "status"=>201,
            "users"=> $users,

        ];
        // dd($users);
        // return view("user.home", compact('users'));
        return response()->json($users);
    }

    public function getOneUser(Request $request)
    {
        $user = User:: with('posts')->find($request->id);
        if ($user == null) 
        {
            return response()->json(["message" => "User not found"], 404);
        }
        else
        {
            $res = [
                "status"=> 200,
                "user"=> $user,
                // "country" => $user->address->country,// Access the country attribute on the related Address model
            ];
           
            return response()->json($user);
        }

    }

    public function createUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), 
        [
            "name" => 'required|string',
            "email" => "required|string|email",
            "password" => "required|string" 
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            $newUser = User::create($request->all());
            $newUser->address()->create([
                "country" => "USA",
            ]);
            $res = [
                'status'=> 201,
                'user'=> $newUser,
            ];
            return response()->json($res);
        }
      
    }
    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        $res = [
            "message" =>"deleted successfully",
            "status"=> 200,
            "user" =>$user,

        ];
        return response()->json($res);
    }
}
