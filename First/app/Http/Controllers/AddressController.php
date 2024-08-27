<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Validator;
use App\Models\Address;

class AddressController extends Controller
{
    

    public function getAllAddresses(Request $request)
    {
        $address = Address::get();
        $res = [
            'status'=> 201,
            'address'=> $address,
        ];
        return response()->json($res);
    }

    

    public function getOneAddress(Request $request)
    {
        $address = Address:: with('user')->find($request->id);
        if ($address == null) {
            return response()->json(["message" => "Address not found"],404);
        }
        else
        {
            $res = [
                'status'=> 200,
                'address'=> $address,
                // 'user' => $address->user,
            ];
            return response()->json($res);
        }
    }

    public function createAddress(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "country" => "required|string",
        ]);
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
       else{
            $newAddress = Address::create($request->all());
            $res =[
                'status' => 201,
                'address'=> $newAddress,
            ];
            return response()->json($res);
       }
    }

    public function deleteAddress(Request $request)
    {
        $address = Address::find($request->id);
        $address->delete();
        $res = [
            'status'=> 200,
            'address'=> $address,
        ];
        return response()->json($res);
    }
}
