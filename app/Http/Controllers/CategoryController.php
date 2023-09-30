<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();

        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
            'color' => 'required|max:7',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Nueva categoria');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::find($id);
        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $category)
    {
        //
        $category = Category::find($category);
        
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Categorya actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        //
        $category = Category::find($category);
        $category->posts()->each(function($post) {
            $post->delete(); // <-- direct deletion
         });
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Categorya eliminada');
    }
}
