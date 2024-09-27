<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function home()
    {
        $blogs = Blog::where('status', 'published')->orderBy('id', 'desc')->paginate(10);
        return view('blogs.homeTest', compact('blogs'));
    }

    public function homeTest()
    {
        $blogs = Blog::where('status', 'published')->orderBy('id', 'desc')->paginate(10);
        return view('blogs.homeTest', compact('blogs'));
    }




    public function create()
    {
        $tags=Tag::select('id','name')->get();
        $categories = Category::all();
        $authors = Author::all();
        $users=User::select('id','name')->get();
        return view('blogs.add', compact('users','categories', 'authors','tags'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blogs.show', compact('blog'));
    }
    public function showAll($userId)
    {
        $blogs = Blog::where('user_id', $userId)->get();

        return view('blogs.showAll', compact('blogs'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|max:4000|min:20',
            'excerpt' => 'required|string|min:3|max:255',
            'status' => 'required|in:draft,published',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'user_id' => 'required|exists:users,id',
            'slug' => '',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('public');
        }

        $data['slug'] = Str::slug($request->title);
        $blog = Blog::create($data);

        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        }

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');

    }

    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('blogs.index', compact('blogs'));
    }

    public function destroy($id)
    {
        $obj = Blog::findOrFail($id);
        $obj->delete();
        return back()->with('success', 'Blog deleted successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();
        $users=User::select('id','name')->get();
        $tags= Tag::select('id','name')->get();
        return view('blogs.edit',
         compact('blog', 'categories', 'authors','users','tags'));
    }

        public function update(Request $request, $id)
        {
            $data=$request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string|max:4000',
                'excerpt' => 'required|string|max:255',
                'status' => 'required|in:draft,published',
                'category_id' => 'required|exists:categories,id',
                'author_id' => 'required|exists:authors,id',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'user_id' => 'required|exists:users,id',
                'slug' => '',
                'tags' => 'required|array', // التأكد من أن tags مصفوفة
                'tags.*' => 'exists:tags,id' // التأكد من أن كل tag موجود في جدول tags
            ]);

            $blog = Blog::findOrFail($id);

            $blog->update($data);

            if ($request->hasFile('image')) {
                if ($blog->image) {
                    Storage::delete($blog->image);
                }

                $blog->image = $request->file('image')->store('public');
                $blog->save();
            }

            if ($request->has('tags')) {
                $blog->tags()->sync($request->tags);
            }

            return redirect()->route('blogs.index', ['id' => $blog->id])
                ->with('success', 'Blog updated successfully!');
        }


    public function search(Request $request)
    {
        $queue = $request->q;
        $blogs = Blog::where('content', 'LIKE', '%' . $queue . '%')->where('status', 'published')->get();
        return view('blogs.search', compact('blogs'));
    }
}
