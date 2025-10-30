<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motorista;
use Illuminate\Support\Facades\Log;

class MotoristasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motoristas = Motorista::all();
    return view("motorista.index", compact("motoristas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view("motorista.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|size:11|unique:motoristas',
            'cnh' => 'required|string|max:20',
            'telefone' => 'required|string|max:20',
            'transportadora_id' => 'required|exists:transportadoras,id'
        ]);

    try {
        Motorista::create($validated);
        return redirect()->route("motoristas.index")
            ->with("sucesso", "Motorista cadastrado com sucesso!");
        } catch(\Exception $e){
            Log::error("Erro ao salvar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("motoristas.index")
                    ->with("erro", "Erro ao inserir!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $motorista = Motorista::findOrFail($id);
    return view("motorista.show", compact("motorista"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $motorista = Motorista::findOrFail($id);
    return view("motorista.edit", compact("motorista"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|size:11|unique:motoristas,cpf,'.$id,
            'cnh' => 'required|string|max:20',
            'telefone' => 'required|string|max:20',
            'transportadora_id' => 'required|exists:transportadoras,id'
        ]);

        try {
            $motorista = Motorista::findOrFail($id);
            $motorista->update($validated);
            return redirect()->route("motoristas.index")
                    ->with("sucesso", "Motorista alterado com sucesso!");
        } catch(\Exception $e){
            Log::error("Erro ao alterar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("motoristas.index")
                    ->with("erro", "Erro ao alterar!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $motorista = Motorista::findOrFail($id);
            $motorista->delete();
            return redirect()->route("motoristas.index")
                    ->with("sucesso", "Registro excluído!");
        } catch(\Exception $e){
            Log::error("Erro ao excluir o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            return redirect()->route("motoristas.index")
                    ->with("erro", "Erro ao excluir!");
        }
    }
}
