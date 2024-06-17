<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContatoController extends Controller
{
    
    public function index()
    {
        
    }

  
    public function create()
    {
        return Inertia::render('Contato/Create.vue',[
            'title' => 'Contato',
            'contatos' => [
                'nome' => '',
                'email' => '',
                'telefone' => '',
                'mensagem' => ''
            ]
        ]);
        
    }

   
    public function store(Request $request)
    {
        
        $request->validate([
            'nome'          => 'required|min:4|max:60',
            'email'         => 'required|email',
            'telefone'      => 'required|min:11|max:11',
            'mensagem'      => 'required|min:5|max:500'
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'O nome já está em uso.',
            'nome.max' => 'O nome não pode ter mais de 100 caracteres.',
            'nome.min' => 'O nome deve ter pelo menos 4 caracteres.',
            'email.required' => 'O email é um campo obrigatório',
            'email.email'    => 'Esse formato não é um Email',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.max' => 'O telefone deve ter no máximo 11 números.',
            'telefone.min' => 'O telefone deve ter no mínimo 11 números.',
            'telefone.integer' => 'O telefone deve ser um número inteiro.',
            'mensagem.required' => 'O campo mensagem é obrigatório.',
            'mensagem.max' => 'A mensagem não pode ter mais de 500 caracteres.',
            'mensagem.min' => 'A mensagem deve ter pelo menos 5 caracteres.'
        ]);

        $contato = Contato::create([
            'user_id'       => Auth::user()->id,
            'nome'          => $request->nome,
            'email'         => $request->email,
            'telefone'      => $request->telefone,
            'mensagem'      => $request->mensagem,
        ]);

        if($contato){
            $this->enviarEmail($contato);
            return to_route('produto.home')->with('message', 'Contato para o email '.$contato->email.' enviado com sucesso');
        }
        
        return to_route('contato.create')->with('message', 'Erro ao criar o contato');
    }

    public function show(Contato $contato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contato $contato)
    {
        //
    }

    public function enviarEmail(Contato $contato)
    {
       $email =  Mail::send(new ContactMail($contato));

        return $email;
    }
}
