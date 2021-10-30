<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\komentar;
use App\Models\LikeArtikel;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtikelController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $artikel = DB::table('artikels')
            ->join('users', 'users.id', '=', 'artikels.id_user')
            ->select('artikels.*', 'users.fullname', 'users.foto AS fotoprofile')->orderBy('waktu', 'desc')
            ->get();

        $data = [
            'title' => 'Dashboard Artikel',
            'artikel'  => $artikel,
        ];

        return view('index', $data);
    }

    public function simpan(Request $req)
    {
        $file = $req->foto;
        $ext = $_FILES['foto']['name'];
        $ext = explode('.', $ext);
        $ext = end($ext);
        $newfilename = uniqid() . '.' . $ext;
        if ($file->move('assets/img/artikel', $newfilename)) {
            $artikel = new Artikel();
            $artikel->id_user = user()['id'];
            $artikel->judul = $req->judul;
            $artikel->deskripsi = $req->deskripsi;
            $artikel->foto = $newfilename;
            $artikel->waktu = new DateTime();
            $artikel->save();
            return redirect('/');
        }
    }

    public function like(Request $req)
    {
        $like = new LikeArtikel();
        $like->id_user = user()['id'];
        $like->id_artikel = $req->id;
        $like->save();
        $row_count = $like->count();
        return redirect('/#b' . $req->id);
        // return json_encode($row_count);
    }

    public function unlike(Request $req)
    {
        $like = new LikeArtikel();
        $id_arikel = $like->where(['id' => $req->id])->first()['id_artikel'];
        $like->where(['id' => $req->id])->delete();
        return redirect('/#b' . $id_arikel);
    }

    public function add_comment_artikel(Request $req)
    {
        $komentar = new komentar();
        $komentar->id_user = user()['id'];
        $komentar->id_artikel = $req->id_artikel;
        $komentar->komentar = $req->komentar;
        $komentar->waktu = new DateTime();
        $komentar->save();
        return redirect('/#b' . $req->id_artikel);
    }

    public function semua_komentar(Request $req)
    {
        $artikel = Artikel::join('users', 'users.id', '=', 'artikels.id_user')
            ->select('artikels.*', 'users.fullname', 'users.foto AS fotoprofile')
            ->where('artikels.id', '=', $req->id)
            ->first();

        $komentar = komentar::join('users', 'users.id', '=', 'komentars.id_user')
            ->select('komentars.*', 'users.fullname', 'users.foto')
            ->where('id_artikel', '=', $req->id)->orderBy('waktu', 'desc')->get();
        $data = [
            "title" => "Detail Komentar",
            "artikel" => $artikel,
            "komentar" => $komentar,
        ];
        return view("komentar", $data);
    }

    public function hapus_artikel(Request $req)
    {
        $artikel = new Artikel();
        $artikel = $artikel->where('id', '=', $req->id)->first();
        unlink('assets/img/artikel/' . $artikel['foto']);
        Artikel::where('id', '=', $req->id)->delete();
        komentar::where('id_artikel', '=', $req->id)->delete();
        return redirect('/');
    }
}
