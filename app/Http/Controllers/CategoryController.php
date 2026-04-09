<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = "Category";
        $categories = Category::all();

        // return dd($categories);
        return view('dashboard.category.index', compact('title', 'categories'));
    }

    public function create()
    {
        $title = 'Category - create';

        return view('dashboard.category.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'unique:categories|required'
        ]);

        Category::create($validatedData);

        return redirect('/dashboard/category')->with('success', 'Data kategori berhasil ditambahkan!');
        // return dd($request->all());
    }

    public function edit(Category $category)
    {
        $title = 'Category - edit';
        
        // return dd($category);
        return view('dashboard.category.edit', compact('title', 'category'));
    }

    public function update(Category $category, Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        if (request('slug') != $category->slug) {
            $rules['slug'] = 'unique:categories|required';
        }

        $validatedData = $request->validate($rules);

        Category::where('slug', $category->slug)->update($validatedData);

        return redirect('/dashboard/category')->with('success', 'Data berhasil diubah!!');
    }

    public function delete(Category $category)
    {
        Category::destroy($category->id);

        return redirect('/dashboard/category')->with('success', "Data berhasil dihapus!!");
    }

}
