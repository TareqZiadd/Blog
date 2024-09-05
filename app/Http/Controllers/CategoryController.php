<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate();
        return view('categories.index', compact('categories'));
    }

    public function destroy($id)
    {
        $obj = Category::findOrFail($id);
        $obj->delete();
        return back()->with('success', 'Category deleted successfully.');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('categories.edit', compact('category'));
    }

    public function update($id, Request $request)
    {
        $obj = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|min:3|max:80|regex:/^[^\d]*$/',
            'slug' => [
                'required',
                'min:5',
                'max:70',
                'regex:/^[a-z0-9]+(-[a-z0-9]+)+$/', // Regex to ensure lowercase letters and dashes
            ]
        ]);
        $obj->name = $request->name;
        $obj->slug = $request->slug;
        $obj->save();
        return back()->with('success', 'Category updated successfully');
    }

    public function create()
    {
        return view('categories.add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:80|regex:/^[^\d]*$/',
            'slug' => ''
        ]);

        $obj = new Category();
        $obj->name = $request->name;
        $obj->slug = Str::slug($request->name);
        $obj->save();
        return back()->with('success', 'Category created successfully');
    }
}
