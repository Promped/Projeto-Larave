<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes',
            'telefone' => 'required|string|max:20',
        ]);

        try {
            Cliente::create($validated);
            return redirect()->route('clientes.index')
                    ->with('sucesso', 'Cliente cadastrado com sucesso!');
        } catch(\Exception $e) {
            Log::error("Erro ao cadastrar cliente: ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('clientes.index')
                    ->with('erro', 'Erro ao cadastrar cliente!');
        }
    }

    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,'.$id,
            'telefone' => 'required|string|max:20',
        ]);

        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($validated);
            return redirect()->route('clientes.index')
                    ->with('sucesso', 'Cliente atualizado com sucesso!');
        } catch(\Exception $e) {
            Log::error("Erro ao atualizar cliente: ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('clientes.index')
                    ->with('erro', 'Erro ao atualizar cliente!');
        }
    }

    public function destroy(string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            return redirect()->route('clientes.index')
                    ->with('sucesso', 'Cliente excluído com sucesso!');
        } catch(\Exception $e) {
            Log::error("Erro ao excluir cliente: ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            return redirect()->route('clientes.index')
                    ->with('erro', 'Erro ao excluir cliente!');
        }
    }
}