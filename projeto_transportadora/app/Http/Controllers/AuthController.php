<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller{

    public function showLoginForm(){
        return view("login");
    }

    public function showFormCadastro(){
        return view('cadastro');
    }

    public function cadastrarUsuario(Request $request){
        try{
            $dados = $request->all();
            $dados['password'] = Hash::make($dados['password']);
            User::create($dados);
            return redirect()->route('login')
                ->with("sucesso", "Novo usuário registrado!");
        } catch (Exception $e){
            Log::error("Erro ao criar o usuário: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
        }
    }

    public function login(Request $request){
        $credenciais = $request->only('email', 'password');
        if (Auth::attempt($credenciais)){
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->nivel == "ADM"){
                return redirect()->intended("/inicial-adm");
            } elseif ($user->nivel == "CLI"){
                return redirect()->intended("/inicial-cli");
            }
        } else {
            return redirect()->route('login')
                ->with('erro', "Credenciais inválidas!");
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("login");
    }

}