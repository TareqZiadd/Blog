<?php

namespace App\Http\Controllers;

use App\Models\Author;

use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function index()
    {

        $authors = Author::orderBy('id', 'desc')->paginate(10);

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.add');
    }

    public function destroy($id)
    {
        $del = Author::findOrFail($id);
        $del->delete();
        return back()->with('success', 'Author deleted successfully');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }


    public function update($id, Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:7|max:80|regex:/^[^\d]*$/',
            'email' => 'required|email|string|max:40|regex:/^[^\d]*$/',
            'bio' => 'required|min:20|max:4000|regex:/^[^\d]*$/',
        ]);

        $obj = Author::findOrFail($id);
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->bio = $request->bio;

        $obj->save();

        return back()->with('success', 'Author details updated successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:7|max:100',
            'email' => 'required|email|max:40',
            'bio' => 'required|string|min:20|max:4000'
        ]);

        $obj = new Author();
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->bio = $request->bio;
        $obj->save();
        return back()->with('success', 'Author created successfully');
    }
}
