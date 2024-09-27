<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tag;
    class TagController extends Controller
    {

   public function update(Request $request, Tag $tag)
        {
            $request->validate([
                'name' => 'required|string|min:3|max:255',
            ]);

            $tag->update($request->all());
            return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
        }

        public function destroy(Tag $tag)
        {
            $tag->delete();
            return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
        }
  

        public function showAll($blog_id)
        {
            $tags = Tag::where('blog_id', $blog_id)->get();
            return view('tags.showAllPosts', compact('tags'));
        }

        public function create()
        {
            return view('tags.create');
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                        'name' => 'required|string|min=3|max:25',
            ]);

            Tag::create($validatedData);

            return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
        }


        public function show(Tag $tag)
        {
            return view('tags.show', compact('tag'));
        }

        public function edit(Tag $tag)
        {
            return view('tags.edit', compact('tag'));
        }


        function index()
        {
            $tags = Tag::all();
            return view('tags.index', compact('tags'));

}


    }
