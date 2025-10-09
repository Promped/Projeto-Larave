<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Log;
use Illuminate\support\Facades\Hash;
use App\Models\User;



class AuthController extends Controller
{
    public function showFormLogin()
    {
        return view("login");
    }


    public function ShowFormCadastro()
    {
    return view("cadastro");
    }

    public function cadastrarUsuario(Request $request){

        try{
            $dados = $request->all();
            $dados['password'] = bcrypt($dados['password']);
            User::create($dados);
           
            return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso');
        }catch (Exception $e){
            log::error('Erro ao cadastrar usuário: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('cadastro')->with('error', 'Erro ao cadastrar usuário');
        }

        
    }

    public function login(Request $request)
    {
         $credenciais = $request ->only('email', 'password');
         if (Auth::attempt($credenciais)){
            $request->session()->regenerate();
            return redirect()->route('inicial');
         } else{
            return redirect()->route('login')
            ->with('error', 'Email ou senha inválidos');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
        

    
    }







}
