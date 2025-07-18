<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SampelController extends Controller
{
    public function input(): View
    {
        $title = "Input Permohonan Ambil Sampel";
        $inpspl = true;
        $lahans = Datatani::whereNotNull('gkp')->latest()->get([
            'id',
            'lapang',
            'no_blok',
            'varietas',
            'panen',
            'taksasi',
            'tonase',
            'luas_akhir',
            'gkp',
            'cbb',

        ]);
        // // Kirim data ke view
        return view('lahan', compact('title', 'lahans', 'inpprs'));
    }
}
