<?php

namespace App\Http\Controllers;

use App\Models\Produto;
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
        return Inertia::render('User/Login.vue',[
            'isLoggedIn' => Auth::check()
        ]);
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
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.unique' => 'O email já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
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
        $request->session()->regenerate();

        return Inertia::render('Site/Second.vue');

    }

    public function store(Request $request)
    {
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return to_route("produto.home"); //->with('message', 'Seja Bem vindo');
        }

        return Inertia::render('User/Login.vue', [
            'errorMessage' => 'Email ou senha incorretos!'
        ]);

    }
    
    public function edit($id)
    {
        $produto = Produto::find($id);

        if(!$produto){
            return redirect()->route('produto.home')->with('error', 'Registro não encontrado.');
        }

        return Inertia::render('Produto/Edit.vue',[
            'title'         => 'Editar Produto',
            'produtos'      => $produto
        ]);
       
    }

    
    public function update(Request $request, $id)
    {

        $produto = Produto::find($id);

        if(!$produto){
            return redirect()->route('produto.home')->with('error', 'Registro não encontrado.');
        }

        $produto->update($request->all());

        return redirect()->route('produto.home')->with('error', 'Registro não encontrado.');
        
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return Inertia::render('Site/Index.vue');
    }
}
