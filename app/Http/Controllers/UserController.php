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
            'email' => 'required|unique:users|email',
            'password' => 'required',
        ], [
            'name.required'     => 'O campo nome é obrigatório.',
            'email.required'    => 'O campo email é obrigatório.',
            'email.unique'      => 'O email já está em uso.',
            'email.email'       => 'O Formato do email é invalido.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->back()->with('message', 'Email já cadastrado!');
        }

        $user = User::create($userData);

        Auth::login($user);
        $request->session()->regenerate();

        return to_route("produto.home")->with("message", "Bem vindo ". $user->name);

    }

    public function store(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ], [
            'email.required'    => 'O campo email é obrigatório.',
            'email.email'       => 'Formato de email é invalido.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return to_route("produto.home")->with("message", "Bem vindo ". Auth::user()->name);
        }else{
            return to_route("login.index")->with("message", "Usuário ou Senha incorretos");
        }
    }

    public function edit($id)
    {
        $produto = Produto::find($id);

        if(!$produto){
            return redirect()->route('produto.home')->with('message', 'Registro não encontrado.');
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
            return redirect()->route('produto.home')->with('message', 'Registro não encontrado.');
        }

        $produto->update($request->all());

        return redirect()->route('produto.home')->with('message', 'Registro não encontrado.');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route("site.index")->with("message", "Deslogado com sucesso!");
    }
}
