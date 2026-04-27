<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // En son eklenen en üstte
        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:users,name',
        'password' => 'required|string|min:3',
        'role' => 'required', // Kısıtlamayı şimdilik kaldırdık
    ]);

    // Kayıt öncesi gelen veriyi görmek istersen buraya dd($request->all()); yazabilirsin.

    User::create([
        'name' => $request->name,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    return redirect('/users')->with('success', 'Kullanıcı eklendi.');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return redirect('/users')->with('error', 'Kendi hesabını silemezsin.');
        }

        $user->delete();

        return redirect('/users')->with('success', 'Kullanıcı silindi.');
    }
}