<?php

namespace App\Http\Controllers; // where I'm ?!

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller // StudlyCase
{

//    public function firstAction() // camelCase
//    {
//        $localName = 'Ziad';   // the var ( $localName ) will be assigned to the var ( $name ) in this case ( in the test view )
//        $LocalBooks = ['HTML' , 'CSS' , 'JS']; // the same here also!
//        return view('test' , ['name' => $localName , 'books' => $LocalBooks]); // view -> is a global helper method
//    }

    public function index()
    {
        // static data:
//        $allPosts = [
//            ['id' => 1 , 'title' => 'PHP', 'posted_by' => 'Ziad' , 'created_at' => '31/1/2024'],
//            ['id' => 2 , 'title' => 'JS', 'posted_by' => 'Ahmed' , 'created_at' => '31/1/2024'],
//            ['id' => 3 , 'title' => 'HTML', 'posted_by' => 'Mohamed' , 'created_at' => '31/1/2024'],
//            ['id' => 4 , 'title' => 'CSS', 'posted_by' => 'Embaby' , 'created_at' => '31/1/2024']
//        ];
//        return view('posts.index' , ['posts' => $allPosts]);

        // dynamic data from database:
        $PostsFromDb = Post::all(); // // collection object
        return view('posts.index' , ['posts' => $PostsFromDb]);
    }

//    public function show ($postId)
//    {
//        // static data:
////        $singlePost = [
////            'id' => 1 , 'title' => 'PHP' , 'description' => ' I love This Language ' , 'posted_by' => 'Ziad' , 'created_at' => '2/3/2024' , 'email' => 'ziadMembaby@outlook.com'
////        ];
////        return view('posts.show' , ['post' => $singlePost]);
//
//        // dynamic data from database:
//        //$singlePostFromDb = Post::where('id',$postId); // eloquent builder
//        //$singlePostFromDb = Post::where('id',$postId)->first(); // single model object
//        //$singlePostFromDb = Post::where('id',$postId)->get(); // collection object has one item only  ( for ex: search with title to get all posts with the title ex:( php );
//
//        // if the id not found :
//        $singlePostFromDb = Post::find($postId); // model object
//        if (is_null($singlePostFromDb)) {
//            return to_route('posts.index');
//        }
//
//        // or :
////        $singlePostFromDb = Post::findorfail($postId);
//
//        return view('posts.show' , ['post' => $singlePostFromDb]);
//    }

    // route model binding :
    public function show (Post $post) // type hinting ( $post -> that we wrote in web.php (Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')));
    {
        return view('posts.show' , ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create',['users' => $users]);
    }

    public function store ()
    {
        // validation:
        request()->validate([
            'title' => ['required' , 'min:3'],
            'description' => ['required' , 'min:10'],
            'posted_by' => ['required' , 'exists:users,id']
        ]);

        // 1-get the user's data
        //$data = request()->all(); // request -> global helper method and its return an object / all -> a property of the request object

        // or :
        $title = request()->title;
        $description = request()->description;
        $posted_by = request()->posted_by;

        // 2-store the user's data in the database
//        $post = new Post;
//        $post->title = $title;
//        $post->description = $description;
//        $post->save();

        // mass assignment:
        Post::create([
           'title' => $title,
           'description' => $description,
            'user_id' => $posted_by
        ]);

        // 3-redirection to index
        return to_route('posts.index'); // to_route -> global helper method
    }

    public function edit (Post $post)
    {
        $users = User::all();
        return view('posts.edit' , ['users' => $users , 'post' => $post]);
    }

    public function update (Post $post)
    {
        request()->validate([
           'title' => ['required' , 'min:3'],
           'description' => ['required' , 'min:10'],
           'posted_by' => ['required' , 'exists:users,id']
        ]);

        $title = request()->title;
        $description = request()->description;
        $posted_by = request()->posted_by;

        // update the post
        $post->update([
           'title' => $title,
           'description' => $description,
            'user_id' => $posted_by
        ]);

        return to_route('posts.show',$post->id);
    }

    public function destroy (Post $post) // route model binding
    {
        // delete the post from database:
        $post->delete();
        return to_route('posts.index');
    }
}
