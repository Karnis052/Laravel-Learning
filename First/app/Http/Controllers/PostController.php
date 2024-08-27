<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function getAllPosts(Request $request)
    {
       try
       {
        $posts = DB::select('select * from posts where type = ?', [2]);
        // $posts = Post::get();
        // $res = [
        //     "status" => 200,
        //     "posts" =>$posts,
        // ];
        return response()->json($posts);
       }catch (\Exception $e){
        return response()->json(['error'=> $e->getMessage()], 500);
       }
    }

    public function getOnePost(Request $request)
    {
        try{
            $post = Post:: with(['user', 'tag'])->findOrFail($request->id);
            $res = [
                'status' =>200,
                'post' =>$post,
            ];
            return view('user.home', compact('users'));
            // return response()->json($res);  

        }catch(ModelNotFoundException $e)
        {
            return response()->json(['error'=> $e->getMessage()],404);
        }
        catch (\Exception $e){
            return response()->json(['error'=> $e->getMessage()],500);
        }
    }

    public function createPost(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), 
            [
                'title'=> 'required|string',
                'type' => 'required|integer',
                'user_id' => 'required|sometimes',
            ]);

            if( $validator->fails() )
            {
                return response()->json(['error'=> $validator->errors()],422);
            }
            $newPost = Post::create($request->all());
            $res = [
                'status'=> 200,
                'post'=>$newPost,
            ];
            return response()->json($res);


        }catch (\Exception $e){
            return response()->json(['error'=> $e->getMessage()],500);
        }
    }

    public function deletePost(Request $request)
    {
        try{
            $post = Post:: with(['user', 'tag'])->findOrFail($request->id);
            $res = [
                'status' =>200,
                'post' =>$post,
            ];
            $post->delete();
            return response()->json($res);

        }catch(ModelNotFoundException $e)
        {
            return response()->json(['error'=> $e->getMessage()],404);
        }
        catch (\Exception $e){
            return response()->json(['error'=> $e->getMessage()],500);
        }
    }

    public function createPostWithTags(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            "type" =>  'required|integer',
            'tags' => 'required|array',
            'tags.*' => 'required|max:50'
        ]);

        try{
            DB::beginTransaction();
            $post = Post::create([
                'user_id' => $validatedData['user_id'],
                'title'=> $validatedData['title'],
                'type'=> $validatedData['type']
            ]);

            $tagsId = [];
            foreach($validatedData['tags'] as $tagName){
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagsId[] = $tag->id;

            }
            $post->tags()->attach($tagsId);
            DB::commit();
            return response()->json([
                'message' => 'Post created successfully with tags',
                'post' => $post->load('tags')
            ], 201);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'message' => 'An error occurred while creating the post',
                'error' => $e->getMessage()
            ], 500);    
        }
    }
}
