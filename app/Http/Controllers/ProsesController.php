<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProsesController extends Controller
{
    //
    public function input(): View
    {
        $title = "Input Data Proses";
        $inpprs = true;
        $lahans = Datatani::whereNotNull('panen')->latest()->get([
            'id',
            'lapang',
            'no_blok',
            'panen',
            'taksasi',
            'tonase',
            'luas_akhir',
        ]);
        // // Kirim data ke view
        return view('lahan', compact('title', 'lahans', 'inpprs'));
    }
}
