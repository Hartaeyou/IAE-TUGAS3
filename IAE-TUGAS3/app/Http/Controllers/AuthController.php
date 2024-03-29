<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function RegisterUser (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $User= new User();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $saveUserData= $User->save();
        if ($saveUserData){
            return response()->json(['message' => 'Registrasi Berhasil'], 200);
        }
        else {
            return response()->json(['message' => 'Registrasi Gagal'],400);
        }
    }

    public function login (Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(array("message" => "Email atau Password Salah"),422);
        }
        return response()->json(['auth-token' =>$user->createToken('user login')->plainTextToken]);
        
        ;
    }

    public function logout (Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(array("message" => "Anda Sudah Berhasil LogOut"),200);
    }
}
