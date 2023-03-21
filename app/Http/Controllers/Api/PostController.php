<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Jobs\EmailSender;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::paginate(5);
        if ($post->count() > 0) {
            $data = [
                'status' => 200,
                'posts' => $post,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 404,
                'posts' => 'No records found'
            ];

        }

    }

    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());

        if ($post) {
            return response()->json([
                'status' => 200,
                'message' => 'Post created successfully',
            ]);

        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something get wrong',
            ]);

        }
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        if ($post) {
            $data = [
                'status' => 200,
                'posts' => $post,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 404,
                'posts' => 'No records found'
            ];

        }

    }


}
