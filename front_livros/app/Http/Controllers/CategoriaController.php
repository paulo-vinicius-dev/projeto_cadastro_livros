<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoriaController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:8000/api/categorias/');
        $categorias = $response->json();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/categorias/', [
            'nome' => $request->nome,
        ]);

        return redirect()->route('categorias.index');
    }

    public function edit($id)
    {
        $response = Http::get("http://127.0.0.1:8000/api/categorias/{$id}");
        $categoria = $response->json();
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $response = Http::put("http://127.0.0.1:8000/api/categorias/{$id}/", [
            'nome' => $request->nome,
        ]);

        return redirect()->route('categorias.index');
    }

    public function destroy($id)
    {
        $response = Http::delete("http://127.0.0.1:8000/api/categorias/{$id}/");
        return redirect()->route('categorias.index');
    }
}