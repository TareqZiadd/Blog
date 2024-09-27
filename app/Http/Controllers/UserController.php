<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $users=User::orderBy("id","desc")->paginate(10);
        return view('users.index',compact('users'));



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create',compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $data= $request->validate([
            'name' => 'required|min:7|max:255',
            'email' => 'required|email|unique:users,email|min:7', //users name of table
            'password'=>'required|min:6 |max:50',
            'password_confirm'=>'required|same:password',
            'type' => 'in:writer,admin'
]);
$data['password']=bcrypt($data['password']);
User::create($data);
        return redirect()->route('blogs.homeTest')->with('success', 'Blog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::findOrFail($id);
        return view('users.edit',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, string $id)
        {
            $user = User::findOrFail($id);
            $data = $request->validate([
                'name' => 'required|min:7|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id, // استثناء المستخدم الحالي
                'type' => 'required|in:writer,admin',
            ]);
        
            $user->update($data);
        
            return back()->with('success', 'Updated successfully');
        }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $user= User::findOrFail($id);
    $user->delete();
    return back()->with('success','Deleted is success');
    }

}
