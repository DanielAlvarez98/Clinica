<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users=User::all();
        $employees = Employee::whereDoesntHave('user')->get();
        
        return view('user.index',['users'=>$users,'employees'=>$employees]);
    }



        public function checkUsername(Request $request)
        {
            $username = $request->input('username');
            
            // Realiza la consulta en la base de datos para verificar si el nombre de usuario ya existe
            $exists = User::where('username', $username)->exists();
            
            return response()->json(['exists' => $exists]);
        }

    public function store(Request $request)
    {
        $request->validate([
            'id_employee' => ['required'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        User::create([
            'id_employee' => $request['id_employee'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('Usuario')->with('flash_message', 'Addedd!');
    }

   
    public function destroy($id)
    {
        $user =User::find($id);
        $user->delete();
        return redirect('Usuario')->with('flash_message', 'deleted!');  
    }
}
