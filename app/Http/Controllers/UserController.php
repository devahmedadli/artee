<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Show the users index page
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('role', 'admin')->where('id', '!=', auth()->id())->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the create user page
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a new user
     * 
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $userData = $request->validated();
        $userData['password'] = Hash::make($userData['password']);

        $user = User::create($userData);
        return to_route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show a user
     * 
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $userData = $request->validated();
        if (isset($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        }

        $user->update($userData);
        return to_route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {

        $user->delete();
        return to_route('users.index')->with('success', 'User deleted successfully.');
    }
}
