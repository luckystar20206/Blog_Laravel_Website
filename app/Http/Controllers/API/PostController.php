<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
class PostController extends Controller
{
    use ApiResponse;
    public function index ()
    {
        $posts = Post::all(); // collection object

        return $this->apiResponse($posts ,200 , 'All Posts Retrieved');
    }

    // route model binding:
//    public function show(Post $post)
//    {
//        return $this->apiResponse($post, 200, 'The Post Retrieved');
//    }

    // the normal way :
    public function show ($id)
    {
        $post = Post::find($id);

        if ($post){
            return $this->apiResponse($post ,200 , 'The Post Retrieved');
        } else {
            return $this->apiResponse(null ,404 , 'Not Found');
        }
    }
}
