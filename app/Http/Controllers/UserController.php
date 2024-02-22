<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('User/Login.vue');
    }

    public function create()
    {
        return Inertia::render('User/Create.vue',[
            'user' =>  [
                'name' => '',
                'email' => '',
                'password' => '',
                'remember_token' => '', 
            ],
        ]);
    }
        
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            return redirect()->back()->with('error', 'Email já cadastrado!');
        }

        $user = User::create($userData);

        Auth::login($user);

       return redirect()->route('site.index')->with('success', 'Conta criada com sucesso!');

    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home.index')->with('success', 'Conta logada com sucesso!');
        }
        return redirect()->route('home.index')->with('error', 'Email ou senha incorretos!');
    }

   
    public function show(string $id)
    {
      
        
    }

    
    public function edit(string $id)
    {
        
    }

   
    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('home.index')->with('success', 'Conta deslogada com sucesso!');
    }
}
