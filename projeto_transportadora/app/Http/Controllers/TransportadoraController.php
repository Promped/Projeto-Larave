<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportadora;
use Illuminate\Support\Facades\Log;

class TransportadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportadoras = Transportadora::all();
        return view("transportadora.index", compact("transportadoras"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("transportadora.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|unique:transportadoras',
            'endereco' => 'required|string',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:transportadoras',
        ]);

        try {
            Transportadora::create($validated);
            return redirect()->route("transportadoras.index")
                    ->with("sucesso", "Transportadora cadastrada com sucesso!");
        } catch(\Exception $e){
            Log::error("Erro ao salvar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("transportadoras.index")
                    ->with("erro", "Erro ao inserir!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transportadora = Transportadora::findOrFail($id);
        return view("transportadora.show", compact("transportadora"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transportadora = Transportadora::findOrFail($id);
        return view("transportadora.edit", compact("transportadora"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|unique:transportadoras,cnpj,'.$id,
            'endereco' => 'required|string',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:transportadoras,email,'.$id,
        ]);

        try {
            $transportadora = Transportadora::findOrFail($id);
            $transportadora->update($validated);
            return redirect()->route("transportadoras.index")
                    ->with("sucesso", "Transportadora alterada com sucesso!");
        } catch(\Exception $e){
            Log::error("Erro ao alterar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("transportadoras.index")
                    ->with("erro", "Erro ao alterar!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $transportadora = Transportadora::findOrFail($id);
        $transportadora->delete();
        return redirect()->route("transportadoras.index")
            ->with("sucesso", "Registro excluído!");
        } catch(\Exception $e){
            Log::error("Erro ao excluir o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
        return redirect()->route("transportadoras.index")
                    ->with("erro", "Erro ao excluir!");
        }
    }
}
