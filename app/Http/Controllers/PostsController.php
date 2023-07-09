<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Posts;

class PostsController extends Controller
{
    public function posts(){
        $posts = Posts::All();
        return response()->json($posts);
    }
}
