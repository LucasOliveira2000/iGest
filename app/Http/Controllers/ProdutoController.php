<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    
    public function home()
    {   
       
        $produtos = Produto::all()->where('user_id', auth()->user()->id);

        return Inertia::render('Produto/Home.vue',[
            'produtos'      => $produtos
        ]);
        
    }

    public function index()
    {
        
        return Inertia::render('Site/Second.vue');

    }

    
    public function create()
    {
        return Inertia::render('Produto/Create.vue',[
            'title'         => 'Criar Produto',
            'produtos'      => [
                'nome'          => '',
                'marca'         => '',
                'quantidade'    => '',
                'valor'         => ''
            ]
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'              => 'required|min:4|max:20',
            'marca'             => 'required|min:4|max:30',
            'quantidade'        => 'required|integer',
            'valor'             => 'required|integer'
        ], [
            'nome.required'         => 'O campo nome é obrigatório.',
            'nome.min'              => 'O campo nome deve ter no mínimo 4 caracteres.',
            'nome.max'              => 'O campo nome deve ter no máximo 30 caracteres.',
            'marca.required'        => 'O campo marca é obrigatório.',
            'marca.min'             => 'O campo marca deve ter no mínimo 4 caracteres.',
            'marca.max'             => 'O campo marca deve ter no máximo 30 caracteres.',
            'quantidade.required'   => 'O campo quantidade é obrigatório.',
            'quantidade.integer'    => 'O campo quantidade deve ser um número inteiro.',
            'valor.required'        => 'O campo valor é obrigatório.',
            'valor.integer'         => 'O campo valor deve ser um número.'
        ]);

        $produto = Produto::create([
            'user_id'       => Auth::user()->id, 
            'nome'          => $request->nome,
            'marca'         => $request->marca,
            'quantidade'    => $request->quantidade,
            'valor'         => $request->valor,
        ]);

        return redirect()->route('produto.home')->toast('sucesso', 'Produto'.$produto->nome.'criado com sucesso.');
    }

    public function show(Produto $produto)
    {
        
    }

    
    public function edit(Produto $produto, $id)
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

   
    public function destroy($id)
    {
       
        $produto = Produto::find($id);

        if (!$produto) {
            return redirect()->route('produto.home')->with('error', 'Registro não encontrado.');
        }

        $produto->delete();

        return redirect()->route('produto.home')->toast('Contrato criado com Sucesso!!!', 'success');
     

    }
}
