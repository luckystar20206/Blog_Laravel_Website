<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index ()
    {
        $posts = Post::all(); // collection object

        return response($posts , 200 , [
            'status' => 200,
            'message' => 'All Posts Sent'
        ]);
    }
}
