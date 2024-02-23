<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponse;
    public function index ()
    {
        $posts = PostResource::collection(Post::all()); // collection object

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
            return $this->apiResponse(new PostResource($post) ,200 , 'The Post Retrieved');
        } else {
            return $this->apiResponse(null ,404 , 'Not Found');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10', 'max:255'],
            'posted_by' => ['required', 'exists:users,id']
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, 406, $validator->errors()); // 406 =>  Not Acceptable
        }

        $validatedData = $validator->validated();
        $post = Post::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'user_id' => $validatedData['posted_by']
        ]);

        if ($post) {
            return $this->apiResponse(new PostResource($post), 201, 'The Post Saved');
        } else {
            return $this->apiResponse(null, 500, 'Failed to save the post'); // 500 => Internal Server Error
        }
    }

    public function update (Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10', 'max:255'],
            'posted_by' => ['required', 'exists:users,id']
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, 406, $validator->errors()); // 406 =>  Not Acceptable
        }

        $validatedData = $validator->validated();

        $post = Post::find($id);

        if (!$post) {
            return $this->apiResponse(null, 404, 'The Post Not Found');
        }

        $post->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'user_id' => $validatedData['posted_by']
        ]);

        if ($post) {
            return $this->apiResponse(new PostResource($post), 201, 'The Post Updated');
        } else {
            return $this->apiResponse(null, 500, 'Failed to Update the post'); // 500 => Internal Server Error
        }

    }

    public function destroy ($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return $this->apiResponse(null, 404, 'The Post Not Found');
        }

        $post->delete($id);

        if ($post) {
            return $this->apiResponse(null, 200, 'The Post Deleted');
        }
    }

}
