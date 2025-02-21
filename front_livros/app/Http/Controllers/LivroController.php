<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LivroController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:8000/api/livros/');
        $livros = $response->json();
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        $autoresResponse = Http::get('http://127.0.0.1:8000/api/autores/');
        $categoriasResponse = Http::get('http://127.0.0.1:8000/api/categorias/');
        $autores = $autoresResponse->json();
        $categorias = $categoriasResponse->json();
        return view('livros.create', compact('autores', 'categorias'));
    }

    public function store(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/livros/', [
            'titulo' => $request->titulo,
            'isbn' => $request->isbn,
            'ano_publicacao' => $request->ano_publicacao,
            'autores' => $request->autores,
            'categorias' => $request->categorias,
        ]);

        return redirect()->route('livros.index');
    }

    public function edit($id)
    {
        $livroResponse = Http::get("http://127.0.0.1:8000/api/livros/{$id}/");
        $autoresResponse = Http::get('http://127.0.0.1:8000/api/autores/');
        $categoriasResponse = Http::get('http://127.0.0.1:8000/api/categorias/');
        $livro = $livroResponse->json();
        $autores = $autoresResponse->json();
        $categorias = $categoriasResponse->json();
        return view('livros.edit', compact('livro', 'autores', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $response = Http::put("http://127.0.0.1:8000/api/livros/{$id}/", [
            'titulo' => $request->titulo,
            'isbn' => $request->isbn,
            'ano_publicacao' => $request->ano_publicacao,
            'autores' => $request->autores,
            'categorias' => $request->categorias,
        ]);

        return redirect()->route('livros.index');
    }

    public function destroy($id)
    {
        $response = Http::delete("http://127.0.0.1:8000/api/livros/{$id}/");
        return redirect()->route('livros.index');
    }
}
