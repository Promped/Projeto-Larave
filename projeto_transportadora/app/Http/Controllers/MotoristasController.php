<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motoristas;
use Illuminate\Support\Facades\Log;

class MotoristasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motoristas = Motoristas::all();
        return view("motoristas.index", compact("motoristas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("motori$motoristas.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Motorista::create($request->all());
            return redirect()->route("motoristas.index")
                    ->with("sucesso", "Registro inserido!");
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
        $motoristas = Motoristas::findOrFail($id);
        return view("motoristas.show", compact("motoristas"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $motoristas = Motoristas::findOrFail($id);
        return view("motoristas.edit", compact("motoristas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $motoristas = Motoristas::findOrFail($id);
            $motoristas->update($request->all());
            return redirect()->route("motoristas.index")
                    ->with("sucesso", "Registro alterado!");
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
            $motoristas = Motoristas::findOrFail($id);
            $motoristas->delete();
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
