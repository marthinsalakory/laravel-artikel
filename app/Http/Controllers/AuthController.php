<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\komentar;
use App\Models\LikeArtikel;
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

    public function hapus()
    {
        $user = new User();
        $artikel = new Artikel();
        $komentar = new komentar();
        $like = new LikeArtikel();

        // hapus foto
        unlink('assets/img/profile/' . user()['foto']);

        // hapus tabel like bila ada
        if ($like->where('id_user', '=', user()['id'])->count() > 0) {
            $like->where('id_user', '=', user()['id'])->delete();
        }
        // hapus tabel komentar bila ada
        if ($komentar->where('id_user', '=', user()['id'])->count() > 0) {
            $komentar->where('id_user', '=', user()['id'])->delete();
        }

        // hapus artikel yang dibuat user bila ada
        if ($artikel->where('id_user', '=', user()['id'])->count() > 0) {
            foreach ($artikel->where('id_user', '=', user()['id'])->get() as $a) {
                unlink('assets/img/artikel/' . $a['foto']);
            }
            $artikel->where('id_user', '=', user()['id'])->delete();
        }

        // hapus akun
        $user->where('id', '=', user()['id'])->delete();

        // kembalikan ke logout
        return redirect('/logout');
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
