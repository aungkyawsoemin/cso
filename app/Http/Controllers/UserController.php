<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keywords = $request->get('keywords');
        $query = User::where('id', '!=', Auth::user()->id);
        if($keywords != '') $query->where('name', 'like', $keywords.'%');
        $users = $query->paginate();

        return view('users.index', ['users' => $users, 'keywords' => $keywords]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email_rules = ($request->get('id') > 0)? 'unique:users,email,'.$request->get('id') : 'unique:users';
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|'.$email_rules.'|max:255',
            'password' => ['required', 'confirmed'],
        ]);

        $user = ($request->get('id') > 0)? User::find($request->get('id')): new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->save();

        return redirect()->route('user.edit', ['id' => $user->id])->with('status', 'User data is successfully stored');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
        $user = User::findOrFail($id);
        return view('users.form', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->route('users')->with('status', 'User data is successfully deleted');
    }
}
