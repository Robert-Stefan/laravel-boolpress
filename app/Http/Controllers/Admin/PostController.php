<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all(); 

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDAZIONE
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'nullable|mimes:jpg,png,jpeg,gif,svg',
        ], [ //Personalizziamo i messaggi
            'required' => 'The :attribute is required!!',
            'unique' => 'The :attribute is already in use for an another post.',
            'max' => 'Max :max characters allowed for the :attribute.'
        ]);


        $data = $request->all();

        // AGGIUNGI COVER IMAGE SE PRESENTE NEL FORM
        if(array_key_exists('cover', $data)) {
            $img_path = Storage::put('posts-cover', $data['cover']);

            // override cover file with path 
            $data['cover'] = $img_path;
        }

        // gen slug 
        $data['slug'] = Str::slug($data['title'], '-');

        // create and save record on db 
        $new_post = new Post();
        $new_post->fill($data);  // <--!!! FILLABLE
        $new_post->save();

        // SALVA RELAZIONE CON TAGS IN TABELLA PIVOT
        if(array_key_exists('tags', $data)) {
            //post_tags
            $new_post->tags()->attach($data['tags']); // aggiunge nuove records nella tabella pivot
        }

        return redirect()->route('adminposts.show', $new_post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // VALIDE  

        $request->validate([
            'title' => [
                'required',
                Rule::unique('posts')->ignore($id),
                'max: 255'
            ],
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags_id' => 'nullable|exists:tags,id'
        ], [ //Personalizziamo i messaggi
            'required' => 'The :attribute is required!!',
            'unique' => 'The :attribute is already in use for an another post.',
            'max' => 'Max :max characters allowed for the :attribute.'
        ]);

        $data = $request-> all();

        $post = Post::find($id);

        // Image Update
        if(array_key_exists('cover', $data)) {
            // delete previous one
            if($post->cover) {
                Storage::delete($post->cover);
            }

            // set new one
            $data['cover'] = Storage::put('posts-cover', $data['cover']);
        }

        // gen slug  
        if($data['title'] != $post->title) {
            $data['slug'] = Str::slug($data['title'], '-');
        }

        $post->update($data); // <-- FILLABLE 

        // AGGIORNA RELAZIONE TABELLA PIVOT 
        if(array_key_exists('tags', $data)) {
            // aggiunta records tabella pivot 
            $post->tags()->sync($data['tags']); // aggiunge / rimuove update
        } else {
            $post->tags()->detach(); // rimuove tutte le records nella pivot
        }

        return redirect()->route('adminposts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // rimozione eventuale immagine associata
        if($post->cover) {
            Storage::delete($post->cover);
        }

        //pulizia orfani da tabella pivot 
        $post->tags()->detach();

        // remove
        $post->delete();

        return redirect()->route('adminposts.index')->with('deleted', $post->title);
    }
}
