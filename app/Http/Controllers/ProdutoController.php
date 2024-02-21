<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    
    public function home(){   
       
        $produtos = Produto::all();

        return Inertia::render('Produto/Home.vue',[
            'produtos'      => $produtos
        ]);
        
    }

    public function index(){
        
        return Inertia::render('Site/Index.vue');

    }

    
    public function create()
    {
        
        
        return Inertia::render('Produto/Create.vue',[
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
            'nome'          =>  'required|min:4|max:30',
            'marca'          => 'required|min:4|max:30',
            'quantidade'    =>  'required|Integer',
            'valor'         =>  'required|numeric'
        ]);

        $produto = Produto::create([
            'nome'          => $request->nome,
            'marca'         => $request->marca,
            'quantidade'    => $request->quantidade,
            'valor'         => $request->valor
        ]);

        return redirect()->route('produto.home')->with(['message' => 'Produto '. $produto .' criado com sucesso']);

    }

   
    public function show(Produto $produto)
    {
        
    }

    
    public function edit(Produto $produto)
    {
       
    }

    
    public function update(Request $request, Produto $produto)
    {
        
    }

   
    public function destroy($id)
    {
       
        $produto = Produto::find($id);

        if (!$produto) {
            return redirect()->route('produto.home')->with('error', 'Registro não encontrado.');
        }

        $produto->delete();

        return redirect()->route('produto.home')->with('message', 'Produto deletado com sucesso');
     

    }
}
