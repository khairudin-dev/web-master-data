<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LahanController extends Controller
{
    public function getDetail($no_blok): Response
    {
        // dd($lahan);
        $lahan = Datatani::select('id', 'no_blok', 'lapang', 'nama', 'alamat', 'varietas', 'kb', 'musim', 'lokasi', 'i_label', 'label_sumber', 'semai', 'tanam', 'luas', 'permohonan')->where('no_blok', $no_blok)->firstOrFail();
        // dd($lahan);
        return response()->view('partials.detail-lahan', compact('lahan'));
    }
    public function bukuBesar(): View
    {
        $title = "Daftar Data Buku Besar";
        $bubes = true;
        $lahans = Datatani::latest()->get([
            'id',
            'lapang',
            'no_blok',
            'varietas',
            'kb',
            'alamat',
            'label_sumber',
            'semai',
            'tanam',
            'luas',
            'tg_pendahuluan',
            'tg_pl1',
            'tg_pl2',
            'tg_pl3',
            'panen',
            'lulus',
            'taksasi',
            'tonase',
            'umur_padi',
            'gkp',
            'cbb',
            'tg_pengambilan',
            'tg_selesai',
            'ka',
            'kecambah',
            'mutu',
            'tonase_sertifikat',
            'no_sertifikat',
            'tg_kadaluarsa',
            'label',
            'seri_label',
            'bantuan',
            't_bantuan',
            'market',
            't_market',
            'penangkaran',
            't_penangkaran',


        ]);
        // // Kirim data ke view
        return view('lahan', compact('title', 'lahans', 'bubes'));
    }
}
