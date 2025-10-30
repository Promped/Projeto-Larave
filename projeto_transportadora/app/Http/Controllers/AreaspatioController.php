<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AreaPatio;
use Illuminate\Support\Facades\Log;

class AreaspatioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $areaspatio = AreaPatio::all();
    return view("areaspatio.index", compact("areaspatio"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("areaspatio.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'capacidade' => 'nullable|integer',
            'tipo' => 'nullable|string',
            'status' => 'nullable|string'
        ]);

        try {
            AreaPatio::create($validated);
            return redirect()->route("areaspatio.index")
                    ->with("sucesso", "Área cadastrada com sucesso!");
        } catch(\Exception $e){
            Log::error("Erro ao salvar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("areaspatio.index")
                    ->with("erro", "Erro ao inserir!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $areaspatio = AreaPatio::findOrFail($id);
        return view("areaspatio.show", compact("areaspatio"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $areaspatio = AreaPatio::findOrFail($id);
        return view("areaspatio.edit", compact("areaspatio"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'capacidade' => 'nullable|integer',
            'tipo' => 'nullable|string',
            'status' => 'nullable|string'
        ]);

        try {
            $areaspatio = AreaPatio::findOrFail($id);
            $areaspatio->update($validated);
            return redirect()->route("areaspatio.index")
                    ->with("sucesso", "Área alterada com sucesso!");
        } catch(\Exception $e){
            Log::error("Erro ao alterar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("areaspatio.index")
                    ->with("erro", "Erro ao alterar!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $areaspatio = AreaPatio::findOrFail($id);
            $areaspatio->delete();
            return redirect()->route("areaspatio.index")
                    ->with("sucesso", "Registro excluído!");
        } catch(\Exception $e){
            Log::error("Erro ao excluir o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            return redirect()->route("areaspatio.index")
                    ->with("erro", "Erro ao excluir!");
        }
    }
}
