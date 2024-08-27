<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function getAllTags(Request $request)
    {
        try{
            $tags = Tag::get();
            $res = [
                "status"=> 200,
                "tags" => $tags,
            ];
            return response()->json($res);

        }catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()], 500);
        }
    }

    public function getOneTag(Request $request)
    {
        try{
            $tag = Tag::findOrFail($request->id);
            $res = [
                'status'=> 200,
                'tags' => $tag,
            ];
            return response()->json($res);
        }catch(\Exception $e)
        {
            return response()->json(['error'=> $e->getMessage()], 500);
        }
    }

    public function createTag(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), 
            [
                'name'=> 'required|string',
            ]);
        if ($validator->fails())
        {
            return response()->json(['error'=> $validator->errors()],500);
        }
        $newTag = Tag::create($request->all());
        $res = [
            'status'=> 200,
            'tag' => $newTag,   
        ];
        return response()->json($res);

        }catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()], 500);
        }
    }

    public function deleteTag(Request $request)
    {   
        try{
            $tag = Tag::findOrFail($request->id);
            $res = [
                'status'=> 200,
                'tags' => $tag,
            ];
            $tag->delete();
            return response()->json($res);
        }catch(\Exception $e)
        {
            return response()->json(['error'=> $e->getMessage()], 500);
        }

    }
}
