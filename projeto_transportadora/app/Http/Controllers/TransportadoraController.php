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
        try {
            $transportadora = Transportadora::findOrFail($id);
            $transportadora->update($request->all());
            return redirect()->route("transportadora.index")
                    ->with("sucesso", "Registro alterado!");
        } catch(\Exception $e){
            Log::error("Erro ao alterar o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("transportadora.index")
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
            return redirect()->route("transportadora.index")
                    ->with("sucesso", "Registro excluído!");
        } catch(\Exception $e){
            Log::error("Erro ao excluir o registro! ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            return redirect()->route("transportadora.index")
                    ->with("erro", "Erro ao excluir!");
        }
    }
}
