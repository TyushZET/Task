<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\EmailSender;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        $post = Post::all();
        if($post->count() > 0){
            $data = [
                'status' => 200,
                'posts' => $post,
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'status' => 404,
                'posts' => 'No records found'
            ];

        }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:100',
            'description' => 'required|min:5|max:255',
            'website_id' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ]);
        }else{
            $post = Post::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'website_id'=>$request->website_id,
            ]);
        }

        if ($post){
            return response()->json([
                'status' => 200,
                'message' => 'Post created successfully',
            ]);

        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Something get wrong',
            ]);

        }
    }

    public function show($id){
        $post = Post::findOrFail($id);
        if($post){
            $data = [
                'status' => 200,
                'posts' => $post,
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'status' => 404,
                'posts' => 'No records found'
            ];

        }

    }

}
