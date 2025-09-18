<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportadora;
use Illuminate\Suport\Facades\Log;

class TransportadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportadora = Transportadora::all();
        return view("transportadora.index", compact("transportadora"));
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
        try {
            Transportadora::create($request->all());
            return redirect()->route("transportadora.index")
                    ->with("sucesso", "Registro inserido!");
        } catch(\Exception $e){
            Log::error("Erro ao salvar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("transportadora.index")
                    ->with("erro", "Erro ao inserir!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $funcaovisitante = Transportadora::findOrFail($id);
        return view("funcaovisitante.show", compact("funcaovisitante"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $funcaovisitante = Transportadora::findOrFail($id);
        return view("funcaovisitante.edit", compact("funcaovisitante"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $funcaovisitante = Transportadora::findOrFail($id);
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
            $funcaovisitante = Transportadora::findOrFail($id);
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
