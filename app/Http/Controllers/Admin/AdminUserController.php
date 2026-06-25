<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = Admin::with('roles')->paginate(10);
        return Inertia::render('Admin/Users/Index', [
            'admins' => $admins
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia::render('Admin/Users/Form', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.Admin::class,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => 'array',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : Hash::make('password'),
        ]);

        if ($request->has('roles')) {
            $admin->syncRoles($request->roles);
        }

        return redirect()->route('admin.users.index')->with('success', 'Admin created successfully.');
    }

    public function edit(Admin $user)
    {
        $user->load('roles');
        $roles = Role::all();
        
        return Inertia::render('Admin/Users/Form', [
            'admin' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, Admin $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.Admin::class.',email,'.$user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => 'array',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('admin.users.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy(Admin $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Admin deleted successfully.');
    }
}
