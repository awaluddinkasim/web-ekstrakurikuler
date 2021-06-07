<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Str;

use App\Models\Ekstrakurikuler;
use App\Models\Formulir;
use App\Models\Kegiatan;
use App\Models\Prestasi;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' ,'siswa']);
    }

    public function index()
    {
        return view('user.index');
    }

    public function kegiatan($jenis)
    {
        if (auth()->user()->ekstrakurikuler) {
            return redirect('/'.md5('user').'/kegiatan'.'/'.$jenis.'/pengurus');
        }
        if ($jenis == 'riwayat') {
            $kegiatan = Kegiatan::where('jenis', $jenis)->orderBy('id_ekstrakurikuler')->orderBy('tgl_mulai', 'ASC')->orderBy('jam_mulai')->get();

            return view('user.kegiatan', [
                'jenis' => $jenis,
                'daftarKegiatan' => $kegiatan
            ]);
        }
        elseif ($jenis == 'jadwal') {
            $kegiatan = Kegiatan::where('jenis', $jenis)->orderBy('id_ekstrakurikuler')->orderBy('tgl_mulai')->orderBy('jam_mulai')->get();

            return view('user.kegiatan', [
                'jenis' => $jenis,
                'daftarKegiatan' => $kegiatan
            ]);
        }
        return redirect()->routeName('userIndex');
    }

    public function kegiatanPengurus($jenis)
    {
        if ($jenis == 'riwayat') {
            $kegiatan = auth()->user()->ekstrakurikuler->kegiatan->where('jenis', $jenis);
            return view('user.kegiatan-pengurus', [
                'jenis' => $jenis,
                'daftarKegiatan' => $kegiatan
            ]);
        }
        elseif ($jenis == 'jadwal') {
            $kegiatan = auth()->user()->ekstrakurikuler->kegiatan->where('jenis', $jenis);

            return view('user.kegiatan-pengurus', [
                'jenis' => $jenis,
                'daftarKegiatan' => $kegiatan
            ]);
        }
        return redirect()->routeName('userIndex');
    }

    public function kegiatanPengurusTambah(Request $req, $jenis)
    {
        if ($jenis == 'riwayat') {
            $k = new Kegiatan;
            $k->nama = $req->nama;
            $k->tgl_mulai = $req->mulai;
            $k->jam_mulai = $req->jam_mulai;
            $k->tgl_selesai = $req->selesai;
            $k->jam_selesai = $req->jam_selesai;
            $k->id_ekstrakurikuler = auth()->user()->ekstrakurikuler->id;
            $k->jenis = 'riwayat';
            $k->save();
            return redirect('/'.md5('user').'/kegiatan/riwayat');
        } elseif ($jenis == 'jadwal') {
            $k = new Kegiatan;
            $k->nama = $req->nama;
            $k->tgl_mulai = $req->mulai;
            $k->jam_mulai = $req->jam_mulai;
            $k->tgl_selesai = $req->selesai;
            $k->jam_selesai = $req->jam_selesai;
            $k->id_ekstrakurikuler = auth()->user()->ekstrakurikuler->id;
            $k->jenis = 'jadwal';
            $k->save();
            return redirect('/'.md5('user').'/kegiatan/jadwal');
        }
        return redirect()->routeName('userIndex');
    }


    public function ekstrakurikuler()
    {
        if (auth()->user()->ekstrakurikuler) {
            return redirect('/'.md5('user').'/ekstrakurikuler/pendaftar');
        }

        $data = Ekstrakurikuler::get();
        return view('user.ekstrakurikuler', ['daftarData' => $data]);
    }

    public function ekstrakurikulerBatal(Request $req)
    {
        Formulir::destroy($req->id);

        return redirect('/'.md5('user').'/ekstrakurikuler');
    }

    public function ekstrakurikulerFormulir($id)
    {
        return view('user.ekstrakurikuler-formulir');
    }

    public function ekstrakurikulerFormulirSimpan(Request $req, $id)
    {
        $f = new Formulir;
        $f->id_ekstrakurikuler = $id;
        $f->username = auth()->user()->username;
        $f->alamat = $req->alamat;
        $f->tempat_lahir = $req->tempat_lahir;
        $f->tgl_lahir = $req->tgl_lahir;
        $f->usia = $req->usia;
        $f->hp = $req->hp;
        $f->ayah = $req->ayah;
        $f->ibu = $req->ibu;
        $f->hp_ortu = $req->hp_ortu;
        $f->pengalaman_org = $req->pengalaman_org;
        $f->motto = $req->motto;
        $f->gol_darah = strtoupper($req->gol_darah);
        $f->riwayat_penyakit = $req->riwayat_penyakit;
        $f->alasan_masuk = $req->alasan_masuk;
        $f->status = 'pending';
        $f->save();


        return redirect('/'.md5('user').'/ekstrakurikuler');
    }

    public function ekstrakurikulerPendaftar($id = null, $action = null)
    {
        if (!auth()->user()->ekstrakurikuler) {
            return redirect('/'.md5('user').'/ekstrakurikuler');
        }

        if ($id) {
            if ($action) {
                $update = Formulir::find($id);
                if ($action == md5('terima')) {
                    $update->status = 'diterima';
                    $update->save();
                } elseif ($action == md5('tolak')) {
                    $update->status = 'ditolak';
                    $update->save();
                }
                return redirect('/'.md5('user').'/ekstrakurikuler/pendaftar');
            }
            $data = Formulir::find($id);
            return view('user.ekstrakurikuler-formulir-buka', ['data' => $data]);
        }

        $id_ekstrakurikuler = auth()->user()->ekstrakurikuler->id;
        $data = Formulir::where('id_ekstrakurikuler', $id_ekstrakurikuler)->get();
        return view('user.ekstrakurikuler-pendaftar', ['data' => $data]);
    }

    public function prestasi()
    {
        if (auth()->user()->ekstrakurikuler) {
            return redirect('/'.md5('user').'/prestasi/pengurus');
        }
        $prestasi = Prestasi::orderBy('id_ekstrakurikuler', 'ASC')->get();
        return view('user.prestasi', ['daftarPrestasi' => $prestasi]);
    }

    public function prestasiPengurus()
    {
        if (!auth()->user()->ekstrakurikuler) {
            return redirect('/'.md5('user').'/prestasi/pengurus');
        }
        $prestasi = auth()->user()->ekstrakurikuler->prestasi;
        return view('user.prestasi-pengurus', ['daftarPrestasi' => $prestasi]);
    }

    public function prestasiPengurusTambah(Request $req)
    {
        if (!auth()->user()->ekstrakurikuler) {
            return redirect('/'.md5('user').'/prestasi/pengurus');
        }
        $ekstrakurikuler = Ekstrakurikuler::find(auth()->user()->ekstrakurikuler->id);

        $foldername = strtolower(str_replace(' ', '-', $ekstrakurikuler->ekstrakurikuler));

        $file = $req->file('gambar');
        $filename = Str::random(9);

        $p = new Prestasi;
        $p->prestasi = $req->nama;
        $p->id_ekstrakurikuler = auth()->user()->ekstrakurikuler->id;
        $p->tahun = $req->tahun;
        $p->gambar = $filename.'.'.$file->getClientOriginalExtension();
        $p->save();

        $file->move(public_path('img/'.$foldername), $filename.'.'.$file->getClientOriginalExtension());

        return redirect('/'.md5('user').'/prestasi');
    }
}
