<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    // GET BLOG POSTS (archivio)
    public function index() {
        //$posts = Post::all(); 

        $posts = Post::paginate(2);

        return response()->json($posts);
    }

    // GET POST DETAIL BY SLUG
    public function show($slug) {
        // dump($slug);

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        // modifica path cover image se associata
        if($post->cover) {
            $post->cover = url('storage/' . $post->cover);
        }

        return response()->json($post);
    }
}
