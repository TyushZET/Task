<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
    public function index()
    {
        $post = Post::all();
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
}
