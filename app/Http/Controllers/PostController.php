<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    //
    public function index()
    {
        $post = Post::all();
        $categories = Category::all();
        return view('post.index', ['posts' => $post, 'categories' => $categories]);
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:10|max:255',
        ]);
    
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()->route('posts')->with('success', 'Tarea creada correcta mente');
    }
    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts')->with('success', 'Tarea eliminada');
    }

    public function show($id){
        $post = Post::find($id);
        $categories = Category::all();
        return view('post.show', ['posts' => $post, 'categories' => $categories]);
    }

    public function update(Request $request, $id){
        $post = Post::find($id);
        
        $post->title = $request->title;
        $post->save();

        return redirect()->route('posts')->with('success', 'Tarea actualizada');
    }
}
