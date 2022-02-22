<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    $users = User::all();
    return view('users.index', [
        'users' => $users
    ]);
    }

    public function profile()
    {
        $profile = User::all();
        return view('users.edit', compact('profile'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'level' => 'required',
            'password' => 'required|confirmed'
        ]);
        $array = $request->only([
            'name', 'email','level', 'password'
        ]);
        $array['password'] = bcrypt($array['password']);
        User::create($array);
        $request->session()->flash('message1');
        return redirect()->route('users.index');
            
    
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) return redirect()->route('users.index')
            ->with('error_message', 'User dengan id' . $id . ' tidak ditemukan');
        return view('users.edit2', [
            'user' => $user
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'level' => 'required',
            'password' => 'sometimes|nullable|confirmed'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        if ($request->password) $user->password = bcrypt($request->password);
        $user->save();
        $request->session()->flash('message1');
        return redirect()->route('users.index');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        if ($id == $request->user()->id) return redirect()->route('users.index')
            ->with('error_message', 'Anda tidak dapat menghapus diri sendiri.');
        if ($user) $user->delete();
        $request->session()->flash('message2');
        return redirect()->route('users.index');
            
    }
}
