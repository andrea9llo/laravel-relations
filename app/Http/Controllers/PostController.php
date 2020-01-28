<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\PostInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate();

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
          'categories' => Category::all(),
          'tags' => Tag::all()
      ];
      return view('store', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $post  = Post::create($data);
        $tags = Tag::find($data['tags']);
        $category = Category::find($data['category_id']);
        $post -> tags() -> attach($tags);
        $post -> category() -> associate($category);

        $data['post_id'] = $post->id; //Aggiungo campo mancante che proviene dall'inserimento del post
        $data['slug'] = Str::slug($post->title);
        $post = PostInformation::create($data);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      $data = [
          'categories' => Category::all(),
          'tags' => Tag::all(),
          'post' => $post
      ];
      return view('show', $data);
      // $post = Post::findOrFail($post);
      // return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = [
            'categories' => Category::all(),
            'post' => $post
        ];

        return view('edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        //aggiorno il post con tutti i data (lui prenderà solo quelli che interessano alla tabella posts, attraverso la variabile fillable che abbiamo messo nel model)
        $post->update($data);

        //Stessa cosa per i postinformation
        $post->postInformation->update($data);

        //ritorniamo alla home
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Prima cancello la tabella associata, altrimenti non potrei cancellare post che è la tabella padre
        $post->postInformation->delete();

        $post->delete();

        return redirect()->back();
    }
}
