<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProdutoController extends Controller
{

    public function home(Request $request)
    {
        $produtos = Produto::where('user_id', Auth::user()->id)->get();

        return Inertia::render('Produto/Home.vue',[
            'title'         => "Produtos",
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
            'valor'             => 'required|regex:/^\d{1,3}(?:\.\d{3})*(?:,\d{2})?$/',
            'imagem'            => 'image|mimes:jpeg,png,jpg,gif|max:100000'
        ], [
            'nome.required'         => 'O campo nome é obrigatório.',
            'nome.min'              => 'O campo nome deve ter no mínimo 4 caracteres.',
            'nome.max'              => 'O campo nome deve ter no máximo 40 caracteres.',
            'marca.required'        => 'O campo marca é obrigatório.',
            'marca.min'             => 'O campo marca deve ter no mínimo 4 caracteres.',
            'marca.max'             => 'O campo marca deve ter no máximo 30 caracteres.',
            'quantidade.required'   => 'O campo quantidade é obrigatório.',
            'quantidade.integer'    => 'O campo quantidade deve ser um número inteiro.',
            'valor.required'        => 'O campo valor é obrigatório.',
            'valor.decimal'         => 'O campo valor deve ser um número.',
            'imagem.image'          => 'O campo imagem deve ser uma imagem válida.',
            'imagem.mimes'          => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'imagem.max'            => 'A imagem não pode ter mais de 10MB.'
        ]);

        if ($request->hasFile('imagem')) {
            $uploadedImage = $request->file('imagem');
            $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->storeAs('public/produtos', $imageName);
        }

        $valor = converterParaFloat($request->valor);

        $produto = Produto::create([
            'user_id'       => Auth::user()->id,
            'nome'          => $request->nome,
            'marca'         => $request->marca,
            'quantidade'    => $request->quantidade,
            'valor'         => $valor,
            'imagem'        => $imageName ? $imageName :  public_path('storage/produtos/voxlabs.png')
        ]);

        return to_route('produto.home')->with('message', 'Produto '.$produto->nome.' cadastrado com sucesso');
    }

    public function show(Produto $produto)
    {

    }

    public function search(Request $request)
    {
        $query = Produto::query();

        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        if ($request->filled('marca')) {
            $query->where('marca', 'like', '%' . $request->marca . '%');
        }

        if ($request->filled('valor')) {
            $query->where('valor', '>=', $request->valor);
        }

        if ($request->filled('quantidade')) {
            $query->where('quantidade', '<=', $request->quantidade);
        }

        $search = $query->get();

        return Inertia::render("Produto/Home.vue", [
            "search"    => $search
        ]);
    }


    public function edit(Produto $produto, $id)
    {
        $produto = Produto::find($id);

        if(!$produto){
            return redirect()->route('produto.home')->with('message', 'Registro não encontrado.');
        }

        return Inertia::render('Produto/Edit.vue',[
            'title'         => 'Editar Produto',
            'produtos'      => [
                'id'                => $produto->id,
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
            return redirect()->route('produto.home')->with('message', 'Registro não encontrado.');
        }

        $request->validate([
            'nome'              => 'required|min:4|max:20',
            'marca'             => 'required|min:4|max:30',
            'quantidade'        => 'required|integer',
            'valor'             => 'required|regex:/^\d{1,3}(?:\.\d{3})*(?:,\d{2})?$/',
            'imagem'            => 'image|mimes:jpeg,png,jpg,gif|max:10000'
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
            'valor.regex'           => 'O formato está invalido.',
            'imagem.image'          => 'O campo imagem deve ser uma imagem válida.',
            'imagem.mimes'          => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'imagem.max'            => 'A imagem não pode ter mais de 10MB.'
        ]);

        if ($request->hasFile('imagem')) {
            $uploadedImage = $request->file('imagem');
            $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->storeAs('public/produtos', $imageName);
            $produto->imagem = $imageName;
        }

        $produto->update([
            'nome'       => $request->nome,
            'marca'      => $request->marca,
            'quantidade' => $request->quantidade,
            'valor'      => converterParaFloat($request->valor),
            'imagem'     => $produto->imagem
        ]);

        return redirect()->route('produto.home')->with('message', 'Produto atualizado com sucesso');
    }


    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return to_route('produto.home')->with('message', 'Registro não encontrado.');
        }

        $caminhoImagem = $produto->imagem;

        if ($caminhoImagem) {
            Storage::delete('public/produtos/' . basename($caminhoImagem));
            $caminhoPublic = public_path('storage/produtos/' . basename($caminhoImagem));
            if (file_exists($caminhoPublic)) {
                unlink($caminhoPublic);
            }
        }
        $produto->delete();

        return to_route("produto.home")->with('message', 'Produto '.$produto->nome.' deletado com sucesso');
    }
}
