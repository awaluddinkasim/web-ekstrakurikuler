<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $req)
    {
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            return redirect('/login');
        }

        return redirect('/login')->with('failed', 'Username atau Password salah');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $req)
    {
        try {
            $u = new User;
            $u->nama = $req->nama;
            $u->username = $req->nis;
            $u->password = bcrypt($req->password);
            $u->jk = $req->jk;
            $u->level = 'siswa';
            $u->save();
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect('/register')->with('failed', 'Gagal mendaftar, NIS <b>'.$req->nis.'</b> sudah terdaftar pada sistem');
            }
            return redirect('/register')->with('failed', 'Gagal mendaftar');
        }

        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
