<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AutorController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:8000/api/autores/');
        $autores = $response->json();
        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/autores/', [
            'nome' => $request->nome,
        ]);

        return redirect()->route('autores.index');
    }

    public function edit($id)
    {
        $response = Http::get("http://127.0.0.1:8000/api/autores/{$id}");
        $autor = $response->json();
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, $id)
    {
        $response = Http::put("http://127.0.0.1:8000/api/autores/{$id}/", [
            'id' => $id,
            'nome' => $request->nome,
        ]);

        return redirect()->route('autores.index');
    }

    public function destroy($id)
    {
        $response = Http::delete("http://127.0.0.1:8000/api/autores/{$id}/");
        return redirect()->route('autores.index');
    }
}
