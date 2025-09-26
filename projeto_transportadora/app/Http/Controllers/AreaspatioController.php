<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Areaspatio;
use Illuminate\Support\Facades\Log;

class AreaspatioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areaspatio = Areaspatio::all();
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
        try {
            Areaspatio::create($request->all());
            return redirect()->route("areaspatio.index")
                    ->with("sucesso", "Registro inserido!");
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
        $areaspatio = Areaspatio::findOrFail($id);
        return view("areaspatio.show", compact("areaspatio"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $areaspatio = Areaspatio::findOrFail($id);
        return view("areaspatio.edit", compact("areaspatio"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $areaspatio = Areaspatio::findOrFail($id);
            $areaspatio->update($request->all());
            return redirect()->route("areaspatio.index")
                    ->with("sucesso", "Registro alterado!");
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
            $areaspatio = Areaspatio::findOrFail($id);
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
