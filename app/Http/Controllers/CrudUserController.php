<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Hash;
class CrudUserController extends Controller
{
    public static function getAllUsers()
    {
        return User::all();
    }

    public function deleteUser($id)
    {
        if(Session::get('userId') == $id){
            return redirect('dashboard')->with('error', 'Não pode deletar a si mesmo');
        }
        $user = User::find($id);
        $user->delete();
        return redirect('dashboard');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('crud.editUser', compact('user'));
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::find($request->id);

        if($user->email != $request->email){
            $user->update($request->all());
        }
        else
        {
            //update all fields menos email
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
        }


        return redirect('dashboard');
    }

}
