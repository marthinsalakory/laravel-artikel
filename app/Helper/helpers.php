<?php

use App\Models\komentar;
use App\Models\LikeArtikel;
use App\Models\User;

if (!session_id())  session_start();

function user()
{
    $user = new User();
    return $user->where(['id' => $_SESSION['login']])->first();
}


function isLogin()
{
    if (isset($_SESSION['login'])) {
        return true;
    }
    return false;
}

function jumlahLike($val)
{
    $like = new LikeArtikel();
    return $like->where(['id_artikel' => $val])->count();
}

function isLike($val)
{
    $like = new LikeArtikel();
    $data = $like->where('id_user', '=', user()['id'])->where('id_artikel', '=', $val)->get();
    if ($data->count() > 0) {
        // dd($data->first()['id']);
        return $data->first()['id'];
    } else {
        return false;
    }
}

function komentar($val)
{
    $komentar = new komentar();
    return $komentar
        ->join('users', 'users.id', '=', 'komentars.id_user')
        ->select('komentars.*', 'users.fullname', 'users.foto')
        ->where('id_artikel', '=', $val)->limit(1)->orderBy('waktu', 'desc')->get();
}

function jumlahKomentar($val)
{
    $komentar = new komentar();
    return $komentar->where('id_artikel', '=', $val)->count();
}
