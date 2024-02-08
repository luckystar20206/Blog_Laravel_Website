<?php

namespace App\Http\Controllers; // where I'm ?!

use Illuminate\Http\Request;

class  extends Controller // StudlyCase
{
//    public function firstAction() // camelCase
//    {
//        $localName = 'Ziad';   // the var ( $localName ) will be assigned to the var ( $name ) in this case ( in the test view )
//        $LocalBooks = ['HTML' , 'CSS' , 'JS']; // the same here also!
//        return view('test' , ['name' => $localName , 'books' => $LocalBooks]); // view -> is a global helper method
//    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $allPosts = [
            ['id' => 1 , 'title' => 'PHP', 'posted_by' => 'Ziad' , 'created_at' => '31/1/2024'],
            ['id' => 2 , 'title' => 'JS', 'posted_by' => 'Ahmed' , 'created_at' => '31/1/2024'],
            ['id' => 3 , 'title' => 'HTML', 'posted_by' => 'Mohamed' , 'created_at' => '31/1/2024'],
            ['id' => 4 , 'title' => 'CSS', 'posted_by' => 'Embaby' , 'created_at' => '31/1/2024']
        ];
        return view('index' , ['posts' => $allPosts]);
    }
}
