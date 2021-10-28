<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function login()
    {
        $data = [
            'title' => 'Login Artikel',
        ];

        return view('auth/login', $data);
    }

    public function masuk(Request $req)
    {
        $email = $req->email;
        $password = $req->password;
        $user = new User();
        $db = $user->where(['email' => $email, 'password' => $password])->first();
        if ($db) {
            $_SESSION['login'] = $db['id'];
            return redirect('/');
        }

        $req->session()->flash('masuk');
        return redirect('/login');
    }

    public function register()
    {
        $data = [
            'title' => 'Register Artikel',
        ];

        return view('auth/register', $data);
    }

    public function add(Request $reg)
    {
        $file = $reg->foto;
        $ext = $_FILES['foto']['name'];
        $ext = explode('.', $ext);
        $ext = end($ext);
        $newfilename = uniqid() . '.' . $ext;
        if ($file->move('assets/img/profile', $newfilename)) {
            $user = new User();
            $user->fullname = $reg->fullname;
            $user->pekerjaan = $reg->pekerjaan;
            $user->email = $reg->email;
            $user->password = $reg->password;
            $user->foto = $newfilename;
            $user->save();
        }

        $reg->session()->flash('fullname');
        return redirect('/register');
    }

    public function logout()
    {
        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
            session_destroy();
            return redirect('/login');
        }
        return redirect('/login');
    }
}
