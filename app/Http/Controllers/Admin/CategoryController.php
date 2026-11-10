<?php

// app/Http/Controllers/Admin/CategoryController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name'
        ]);

        Category::create($request->only('name'));

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id
        ]);
        //Possible retour le meme nom du 
        $category->update($request->only('name'));

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated');
    }
    public function destroy(Category $category)
    {
        if ($category->events()->count() > 0) {
            return back()->with('error', 'Cannot delete category with events');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted');
    }
    public function create()
    {
        return view('admin.categories.create');
    }

}

