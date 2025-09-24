<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncaoVisitante;
use Illuminate\Suport\Facades\Log;

class FuncaoVisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funcaovisitante = FuncaoVisitante::all();
        return view("funcaovisitante.index", compact("funcaovisitante"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("funcaovisitante.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            FuncaoVisitante::create($request->all());
            return redirect()->route("funcaovisitante.index")
                    ->with("sucesso", "Registro inserido!");
        } catch(\Exception $e){
            Log::error("Erro ao salvar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("funcaovisitante.index")
                    ->with("erro", "Erro ao inserir!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $funcaovisitante = FuncaoVisitante::findOrFail($id);
        return view("funcaovisitante.show", compact("funcaovisitante"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $funcaovisitante = FuncaoVisitante::findOrFail($id);
        return view("funcaovisitante.edit", compact("funcaovisitante"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $funcaovisitante = FuncaoVisitante::findOrFail($id);
            $funcaovisitante->update($request->all());
            return redirect()->route("funcaovisitante.index")
                    ->with("sucesso", "Registro alterado!");
        } catch(\Exception $e){
            Log::error("Erro ao alterar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("funcaovisitante.index")
                    ->with("erro", "Erro ao alterar!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $funcaovisitante = FuncaoVisitante::findOrFail($id);
            $funcaovisitante->delete();
            return redirect()->route("funcaovisitante.index")
                    ->with("sucesso", "Registro excluído!");
        } catch(\Exception $e){
            Log::error("Erro ao excluir o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            return redirect()->route("funcaovisitante.index")
                    ->with("erro", "Erro ao excluir!");
        }
    }
}
