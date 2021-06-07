<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' ,'admin']);
    }

    public function index()
    {
        return view('admin.index');
    }

    public function profil($sub)
    {
        if ($sub == 'sejarah') {
            return view('user.sejarah');
        } elseif ($sub == 'struktur') {
            return view('user.struktur');
        } else {
            return redirect()->routeName('userIndex');
        }
    }

    public function kegiatan($jenis)
    {
        if ($jenis == 'riwayat') {
            $ekstrakurikuler = Ekstrakurikuler::get();
            $kegiatan = Kegiatan::where('jenis', $jenis)->orderBy('id_ekstrakurikuler')->orderBy('tgl_mulai')->orderBy('jam_mulai')->get();

            return view('admin.kegiatan', [
                'jenis' => $jenis,
                'daftarEkstrakurikuler' => $ekstrakurikuler,
                'daftarKegiatan' => $kegiatan
            ]);
        }
        elseif ($jenis == 'jadwal') {
            $ekstrakurikuler = Ekstrakurikuler::get();
            $kegiatan = Kegiatan::where('jenis', $jenis)->orderBy('id_ekstrakurikuler')->orderBy('tgl_mulai')->orderBy('jam_mulai')->get();

            return view('admin.kegiatan', [
                'jenis' => $jenis,
                'daftarEkstrakurikuler' => $ekstrakurikuler,
                'daftarKegiatan' => $kegiatan
            ]);
        }
        return redirect()->routeName('adminIndex');
    }

    public function kegiatanTambah(Request $req, $jenis)
    {
        if ($jenis == 'riwayat') {
            $k = new Kegiatan;
            $k->nama = $req->nama;
            $k->tgl_mulai = $req->mulai;
            $k->jam_mulai = $req->jam_mulai;
            $k->tgl_selesai = $req->selesai;
            $k->jam_selesai = $req->jam_selesai;
            $k->id_ekstrakurikuler = $req->ekstrakurikuler;
            $k->jenis = 'riwayat';
            $k->save();
            return redirect('/'.md5('admin').'/kegiatan/riwayat');
        } elseif ($jenis == 'jadwal') {
            $k = new Kegiatan;
            $k->nama = $req->nama;
            $k->tgl_mulai = $req->mulai;
            $k->jam_mulai = $req->jam_mulai;
            $k->tgl_selesai = $req->selesai;
            $k->jam_selesai = $req->jam_selesai;
            $k->id_ekstrakurikuler = $req->ekstrakurikuler;
            $k->jenis = 'jadwal';
            $k->save();
            return redirect('/'.md5('admin').'/kegiatan/jadwal');
        }
        return redirect()->routeName('adminIndex');
    }

    public function kegiatanHapus(Request $req, $jenis)
    {
        Kegiatan::destroy($req->id);
        return redirect('/'.md5('admin').'/kegiatan/'.$jenis);
    }

    public function ekstrakurikuler()
    {
        $data = Ekstrakurikuler::get();
        $siswa = User::where('level', 'siswa')->doesntHave('ekstrakurikuler')->get();
        return view('admin.ekstrakurikuler', ['daftarData' => $data, 'daftarSiswa' => $siswa]);
    }

    public function ekstrakurikulerTambah(Request $req)
    {
        $data = new Ekstrakurikuler;
        $data->ekstrakurikuler = $req->nama;
        $data->nis_ketua = $req->ketua;
        $data->pembina = $req->pembina;
        $data->save();

        return redirect('/'.md5('admin').'/ekstrakurikuler');
    }

    public function ekstrakurikulerHapus(Request $req)
    {
        Ekstrakurikuler::destroy($req->id);
        return redirect('/'.md5('admin').'/ekstrakurikuler');
    }

    public function prestasi()
    {
        $ekstrakurikuler = Ekstrakurikuler::get();
        $prestasi = Prestasi::orderBy('id_ekstrakurikuler', 'ASC')->get();

        return view('admin.prestasi', [
            'daftarEkstrakurikuler' => $ekstrakurikuler,
            'daftarPrestasi' => $prestasi
        ]);
    }

    public function prestasiTambah(Request $req)
    {
        $ekstrakurikuler = Ekstrakurikuler::find($req->ekstrakurikuler);

        $foldername = strtolower(str_replace(' ', '-', $ekstrakurikuler->ekstrakurikuler));

        $file = $req->file('gambar');

        $filename = Str::random(9);

        $p = new Prestasi;
        $p->prestasi = $req->nama;
        $p->id_ekstrakurikuler = $req->ekstrakurikuler;
        $p->tahun = $req->tahun;
        $p->gambar = $filename.'.'.$file->getClientOriginalExtension();
        $p->save();

        $file->move(public_path('img/'.$foldername), $filename.'.'.$file->getClientOriginalExtension());

        return redirect('/'.md5('admin').'/prestasi');
    }

    public function galeri($id = null)
    {
        if ($id) {
            $data = Ekstrakurikuler::find($id);
            $daftarGaleri = Galeri::where('id_ekstrakurikuler', $id)->get();
            return view('admin.galeri-ekstrakurikuler', ['data' => $data, 'daftarGaleri' => $daftarGaleri]);
        }
        $ekstrakurikuler = Ekstrakurikuler::get();

        return view('admin.galeri', [
            'daftarEkstrakurikuler' => $ekstrakurikuler
        ]);
    }

    public function galeriTambah(Request $req, $id)
    {
        $ekstrakurikuler = Ekstrakurikuler::find($id);

        $foldername = strtolower(str_replace(' ', '-', $ekstrakurikuler->ekstrakurikuler));

        $file = $req->file('gambar');
        $filename = Str::random(7).'.'.$file->getClientOriginalExtension();

        $g = new Galeri;
        $g->id_ekstrakurikuler = $id;
        $g->gambar = $filename;
        $g->save();

        $file->move(public_path('galeri/'.$foldername), $filename);
        return redirect('/'.md5('admin').'/galeri/'.$id);
    }

    public function users($level)
    {
        if ($level == 'admin') {
            $data = User::where('level', $level)->orderBy('username', 'ASC')->get();
            return view('admin.userAdmin', ['daftarAdmin' => $data]);
        } elseif ($level == 'siswa') {
            $data = User::where('level', $level)->orderBy('username', 'ASC')->get();
            return view('admin.userSiswa', ['daftarSiswa' => $data]);
        }
    }
}
