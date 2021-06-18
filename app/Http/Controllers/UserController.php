<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Str;
use Carbon\Carbon;

use App\Models\Ekstrakurikuler;
use App\Models\Formulir;
use App\Models\Galeri;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Setting;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' ,'siswa']);
    }

    public function index()
    {
        $data = Kegiatan::where('jenis', 'jadwal')->where('tgl_mulai', '>=', Carbon::now())->where('tgl_mulai', '<', Carbon::now()->addDays(7))->limit(10)->get();
        $totalSiswa = User::where('level', 'siswa')->get()->count() - User::has('ekstrakurikuler')->get()->count();
        $siswaMendaftar = User::has('formulir')->get()->count();
        return view('user.index', [
            'data' => $data,
            'totalSiswa' => $totalSiswa,
            'siswaMendaftar' => $siswaMendaftar
        ]);
    }

    public function profil($sub)
    {
        if ($sub == 'sejarah') {
            $data = Setting::where('nama', 'sejarah')->first();
            return view('user.sejarah', ['sub' => $sub, 'data' => $data]);
        } elseif ($sub == 'data') {
            $data = Setting::where('nama', 'profil')->first();
            return view('user.profil', ['sub' => $sub, 'data' => $data]);
        } elseif ($sub == 'struktur') {
            $data = Setting::where('nama', 'struktur')->first();
            return view('user.struktur', ['sub' => $sub, 'data' => $data]);
        } else {
            return redirect()->routeName('userIndex');
        }
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

    public function kegiatanPengurus($jenis, $id = null)
    {

        if ($jenis == 'riwayat') {
            $kegiatan = auth()->user()->ekstrakurikuler->kegiatan->where('jenis', $jenis);

            if ($id) {
                $data = Kegiatan::find($id);
                return view('user.kegiatan-pengurus-edit', [
                    'jenis' => $jenis,
                    'data' => $data
                ]);
            }

            return view('user.kegiatan-pengurus', [
                'jenis' => $jenis,
                'daftarKegiatan' => $kegiatan
            ]);
        }
        elseif ($jenis == 'jadwal') {
            $kegiatan = auth()->user()->ekstrakurikuler->kegiatan->where('jenis', $jenis);

            if ($id) {
                $data = Kegiatan::find($id);
                return view('user.kegiatan-pengurus-edit', [
                    'jenis' => $jenis,
                    'data' => $data
                ]);
            }

            return view('user.kegiatan-pengurus', [
                'jenis' => $jenis,
                'daftarKegiatan' => $kegiatan
            ]);
        }
        return redirect()->routeName('userIndex');
    }

    public function kegiatanPengurusTambah(Request $req, $jenis, $id = null)
    {
        if ($id) {
            $data = Kegiatan::find($id);
            $data->nama = $req->nama;
            $data->tgl_mulai = $req->mulai;
            $data->jam_mulai = $req->jam_mulai;
            $data->tgl_selesai = $req->selesai;
            $data->jam_selesai = $req->jam_selesai;
            $data->save();
            return redirect('/'.md5('user').'/kegiatan'.'/'.$jenis);
        } else {

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
    }

    public function kegiatanSelesai(Request $req, $jenis)
    {
        $data = Kegiatan::find($req->id);
        $data->jenis = 'riwayat';
        $data->save();

        return redirect('/'.md5('user').'/kegiatan/'.$jenis);
    }

    public function kegiatanPengurusHapus(Request $req, $jenis)
    {
        Kegiatan::destroy($req->id);

        return redirect('/'.md5('user').'/kegiatan/'.$jenis);
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
        $f->kelas = $req->kelas;
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

    public function prestasiPengurus($id = null)
    {
        if (!auth()->user()->ekstrakurikuler) {
            return redirect('/'.md5('user').'/prestasi/pengurus');
        }

        if ($id) {
            $data = Prestasi::find($id);
            return view('user.prestasi-pengurus-edit', ['data' => $data]);
        }

        $prestasi = auth()->user()->ekstrakurikuler->prestasi;
        return view('user.prestasi-pengurus', ['daftarPrestasi' => $prestasi]);
    }

    public function prestasiPengurusTambah(Request $req, $id = null)
    {
        if (!auth()->user()->ekstrakurikuler) {
            return redirect('/'.md5('user').'/prestasi/pengurus');
        }

        if ($id) {
            $ekstrakurikuler = Prestasi::find($id)->ekstrakurikuler;

            $file = $req->file('gambar');

            $foldername = strtolower(str_replace(' ', '-', $ekstrakurikuler->ekstrakurikuler));

            $file = $req->file('gambar');

            $filename = Str::random(9);

            $data = Prestasi::find($id);
            $data->prestasi = $req->nama;
            $data->tahun = $req->tahun;
            if ($file) {
                $data->gambar = $filename.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('img/'.$foldername), $filename.'.'.$file->getClientOriginalExtension());
            }
            $data->save();


        } else {
            $ekstrakurikuler = Ekstrakurikuler::find(auth()->user()->ekstrakurikuler->id);

            $foldername = strtolower(str_replace(' ', '-', $ekstrakurikuler->ekstrakurikuler));

            $file = $req->file('gambar');
            $filename = Str::random(9);

            $p = new Prestasi;
            $p->prestasi = $req->nama;
            $p->id_ekstrakurikuler = auth()->user()->ekstrakurikuler->id;
            $p->tahun = $req->tahun;
            if ($file) {
                $p->gambar = $filename.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('img/'.$foldername), $filename.'.'.$file->getClientOriginalExtension());
            }
            $p->save();


        }
        return redirect('/'.md5('user').'/prestasi');
    }

    public function prestasiPengurusHapus(Request $req)
    {
        Prestasi::destroy($req->id);
        return redirect('/'.md5('user').'/prestasi/pengurus');
    }

    public function galeri()
    {
        if (auth()->user()->ekstrakurikuler) {
            $id = auth()->user()->ekstrakurikuler->id;
        }

        if ($id) {
            $data = Ekstrakurikuler::find($id);
            $daftarGaleri = Galeri::where('id_ekstrakurikuler', $id)->get();
            return view('user.galeri-ekstrakurikuler', ['data' => $data, 'daftarGaleri' => $daftarGaleri]);
        }
        $ekstrakurikuler = Ekstrakurikuler::get();

        return view('user.galeri', [
            'daftarEkstrakurikuler' => $ekstrakurikuler
        ]);
    }

    public function galeriTambah(Request $req)
    {
        $id = auth()->user()->ekstrakurikuler->id;
        $ekstrakurikuler = Ekstrakurikuler::find($id);

        $foldername = strtolower(str_replace(' ', '-', $ekstrakurikuler->ekstrakurikuler));

        $file = $req->file('gambar');
        $filename = Str::random(7).'.'.$file->getClientOriginalExtension();

        $g = new Galeri;
        $g->id_ekstrakurikuler = $id;
        $g->gambar = $filename;
        $g->save();

        $file->move(public_path('galeri/'.$foldername), $filename);
        return redirect('/'.md5('user').'/galeri');
    }

    public function galeriHapus($id)
    {
        if (auth()->user()->ekstrakurikuler) {
            Galeri::destroy($id);
        }

        return redirect('/'.md5('user').'/galeri');
    }

}
