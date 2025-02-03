<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users', compact('users'));
    }

    public function edit(User $user)
    {
        if ($user->id === 1) {
            return redirect()->back()->with('error', 'No se puede editar al superadmin');
        }
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->id === 1 && !Auth::user()->isSuper()) {
            return redirect()->back()->with('error', 'No tienes permisos para editar al superadmin');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin'
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:8|confirmed';
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        if (!($user->id === 1)) {
            $user->role = $request->role;
        }
        $user->save();

        if (Auth::id() === $user->id && $request->role === 'user') {
            return redirect()->route('home')->with('success', 'Tu rol ha sido actualizado a usuario');
        }

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente');
    }

    public function verify(User $user)
    {
        if ($user->id === 1) {
            return redirect()->back()->with('error', 'No se puede verificar al superadmin');
        }

        $user->email_verified_at = now();
        $user->save();
        return redirect()->back()->with('success', 'Usuario verificado correctamente');
    }

    public function delete(User $user)
    {
        if ($user->id === 1) {
            return redirect()->back()->with('error', 'No se puede eliminar al superadmin');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Usuario eliminado correctamente');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:user,admin'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now()
        ]);

        return redirect()->route('admin.users')->with('success', 'Usuario creado correctamente');
    }
}
