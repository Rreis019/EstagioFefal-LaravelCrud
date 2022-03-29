<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Hash;
class CustomAuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function register()
    {
        return view("auth.register");
    }
    
    public function logout()
    {
        if(Session::has('userId')){
            Session::forget('userId');
        }
        return redirect('/login');
    }

    public function isLogged()
    {
        if(Session::has('userId')){
            return true;
        }
        return false;
    }

    public function dashboard()
    {
        //verify if user is logged in
        $data = array();
        if($this->isLogged()){
            $users = CrudUserController::getAllUsers();
            $userId = Session::get('userId');
            return view("dashboard",compact('users','userId'));
        }

        return redirect("/login")->with('error', 'Não está logado');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required', //verifica se nao esta vazio,se esta no formato email , e se é unico
            'password' => 'required | min:6',
        ]);
        
        $user = User::where('email',$request->input('email'))->first();
        if($user){
            $password = Hash::check($request->input('password'),$user->password);
            if($password){
                Session::put('userId',$user->id);
                return redirect('dashboard');
            }else{
                return back()->with("error","Password incorreta");
            }
        }
        else{
            return back()->with("error","Email não esta registrado");
        }

    }

    public function registerUser(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required | min:6',
        ]);

        $user = new User();
        $user->name = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->input('email');
        $res = $user->save();

        if ($res) {
            return back()->with('success', 'Usuario criado com sucesso!');
        } else {
            return back()->with('error', 'Erro ao criar usuario!');
        }

    }



}
