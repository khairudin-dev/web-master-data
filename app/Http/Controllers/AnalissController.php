<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnalissController extends Controller
{
    public function lapang(): View
    {
        $inplab = true;
        $title = "Input Hasil Uji Laboratorium";
        $lahans = Datatani::whereNotNull('panen')->latest()->get(['id', 'lapang', 'no_blok', 'panen','lulus', "tonase",'taksasi']);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'inplab'));
    }
        public function form($s)
    {
        $lahan = Datatani::select(
            'id',
            'no_blok',
            'lapang',
            'varietas',
            'kb',
            'panen',
            'taksasi',
            'tonase',
            'luas_akhir',
            'i_label',
        )->findOrFail($s);
        if (empty($lahan->panen)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $title = "Input Hasil Uji Laboratorium";
        return view('uji-lab-input', compact('title', "lahan"));
    }
}
