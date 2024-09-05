<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function home()
    {
        $blogs = Blog::where('status', 'published')->orderBy('id', 'desc')->paginate(10);
        return view('blogs.home', compact('blogs'));
    }


    // public function show($id)
    // {
    //     $blog = Blog::findOrFail($id);
    //     return view('blogs.show', compact('blog'));
    // }


    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();

        return view('blogs.add', compact('categories', 'authors'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blogs.show', compact('blog'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|max:4000|min:20',
            'excerpt' => 'required|string|min:3|max:255',
            'status' => 'required|in:draft,published',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'slug' => ''
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->excerpt = $request->excerpt;
        $blog->status = $request->status;
        $blog->category_id = $request->category_id;
        $blog->author_id = $request->author_id;
        $blog->slug = Str::slug($request->title);

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }



    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate();
        return view('blogs.index', compact('blogs'));
    }

    public function destroy($id)
    {
        $obj = Blog::findOrFail($id);
        $obj->delete();
        return back()->with('success', 'Blog deleted successfully.');
    }

    public function edit($slug)
    {
        $blog = Blog::where('slug',$slug)->firstOrFail();
        $categories = Category::all();
        $authors = Author::all();
        return view('blogs.edit', compact('blog', 'categories', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:4000',
            'excerpt' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'slug' => ''
        ]);

        $blog = Blog::findOrFail($id);

        $blog->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'excerpt' => $request->input('excerpt'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),
            'author_id' => $request->input('author_id'),
            'slug' => Str::slug($request->title)
        ]);

        return redirect()->route('blogs.edit', ['id' => $blog->id])
            ->with('success', 'Blog updated successfully!');
    }

    public function search(Request $request)
    {
        $queue = $request->q;
        $blogs = Blog::where('content', 'LIKE', '%' . $queue . '%')->where('status', 'published')->get();
        return view('blogs.search', compact('blogs'));
    }
}
