<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('status', 'Contraseña cambiada con éxito');
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users,email',
        ]);

        $user = Auth::user();
        $user->email = $request->new_email;
        $user->email_verified_at = null;
        $user->save();
        $user->sendEmailVerificationNotification();

        return back()->with('status', 'Correo electrónico cambiado con éxito. Por favor verifica tu nuevo email.');
    }

    public function changeUsername(Request $request)
    {
        $request->validate([
            'new_username' => 'required|unique:users,name', 
        ]);

        $user = Auth::user();
        $user->name = $request->new_username; 
        $user->save();

        return back()->with('status', 'Nombre cambiado con éxito');
    }

    public function delete()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        
        return redirect('/')->with('status', 'Tu cuenta ha sido eliminada');
    }
}