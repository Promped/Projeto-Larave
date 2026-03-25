<?php

namespace App\Http\Controllers;

use App\Models\VagasPatio;
use App\Models\Areaspatio;
use Illuminate\Http\Request;

class VagasPatioController extends Controller
{
    public function index()
    {
        $vagas = VagasPatio::with('area')->get();
        return view('vagas.index', compact('vagas'));
    }

    public function create()
    {
        $areas = Areaspatio::all();
        return view('vagas.create', compact('areas'));
    }

    public function store(Request $request)
    {
        VagasPatio::create($request->all());
        return redirect()->route('vagas.index')->with('sucesso', 'Vaga cadastrada com sucesso!');
    }
}