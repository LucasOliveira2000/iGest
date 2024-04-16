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
                'valor'         => '',
                'imagem'         => '',
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'              => 'required|min:4|max:20',
            'marca'             => 'required|min:4|max:30',
            'quantidade'        => 'required|integer',
            'valor'             => 'required|numeric',
            'imagem'            => 'required|image|mimes:jpeg,png,jpg,gif|max:10000'
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
            'valor.numeric'         => 'O campo valor deve ser um número.',
            'imagem.required'       => 'O campo imagem é obrigatório.',
            'imagem.image'          => 'O campo imagem deve ser uma imagem válida.',
            'imagem.mimes'          => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'imagem.max'            => 'A imagem não pode ter mais de 10MB.'
        ]);

        if ($request->hasFile('imagem')) {
            $uploadedImage = $request->file('imagem');
            $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->storeAs('public/produtos', $imageName);
        }

        $produto = Produto::create([
            'user_id'       => Auth::user()->id, 
            'nome'          => $request->nome,
            'marca'         => $request->marca,
            'quantidade'    => $request->quantidade,
            'valor'         => $request->valor,
            'imagem'        => $imageName
        ]);

        return to_route('produto.home')->with('message', 'Produto '.$produto->nome.' cadastrado com sucesso');
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
            'produtos'      => [
                'nome'              => $produto->nome,
                'marca'             => $produto->marca,
                'quantidade'        => $produto->quantidade,
                'valor'             => $produto->valor,
                'imagem'            => $produto->imagem,
            ]
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if(!$produto){
            return redirect()->route('produto.home')->with('error', 'Registro não encontrado.');
        }

        $request->validate([
            'nome'              => 'required|min:4|max:20',
            'marca'             => 'required|min:4|max:30',
            'quantidade'        => 'required|integer',
            'valor'             => 'required|numeric',
            'imagem'            => 'required|image|mimes:jpeg,png,jpg,gif|max:10000'
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
            'valor.numeric'         => 'O campo valor deve ser um número.',
            'imagem.required'       => 'O campo imagem é obrigatório.',
            'imagem.image'          => 'O campo imagem deve ser uma imagem válida.',
            'imagem.mimes'          => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'imagem.max'            => 'A imagem não pode ter mais de 10MB.'
        ]);

        if ($request->hasFile('imagem')) {
            $uploadedImage = $request->file('imagem');
            $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->storeAs('public/produtos', $imageName);
        }

        $produto->update([
            'nome'          => $request->nome,
            'marca'         => $request->marca,
            'quantidade'    => $request->quantidade,
            'valor'         => $request->valor,
            'imagem'        => $imageName
        ]);

        return redirect()->route('produto.home')->with('message', 'Produto '.$produto->nome.' atualizado com sucesso');
    }

   
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return redirect()->route('produto.home')->with('error', 'Registro não encontrado.');
        }

        $produto->delete();

        return redirect()->route('produto.home')->with('message', 'Produto '.$produto->nome.' deletado com sucesso');
    }

}
