<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProsesController extends Controller
{
    //
    public function input(): View
    {
        $title = "Input Data Proses";
        $inpprs = true;
        $lahans = Datatani::whereNotNull('panen')->whereNull('gkp')->latest()->get([
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
    public function proses_data(): View
    {
        $title = "Daftar Data Proses";
        $prs = true;
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
        return view('lahan', compact('title', 'lahans', 'prs'));
    }
    public function proses(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->panen)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $request->validate([
            'gkp' => 'required|numeric|min:0',
            'cbb' => 'required|numeric|min:0',
        ], [
            "gkp.required" => "Isikan 0 jika memang kosong",
            "gkp.min" => "Isikan 0 jika memang kosong",
            "gkp.numeric" => "GKP wajib diisidengan angkat",
            "cbb.required" => "Isikan 0 jika memang kosong",
            "cbb.min" => "Isikan 0 jika memang kosong",
            "cbb.numeric" => "CBB wajib diisidengan angkat",
        ]);
        // dd($request->nama);
        $lahan->update([
            'gkp' => $request->gkp,
            'cbb' => $request->cbb,
        ]);

        //redirect to index
        return redirect()->route('proses')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
