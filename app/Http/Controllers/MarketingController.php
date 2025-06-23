<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    //
    public function lapang(): View
    {
        $inpmkt = true;
        $title = "Input Data Marketing";

        $lahans = Datatani::whereNotNull('tonase_sertifikat')->latest()->get(['id', 'lapang', 'no_blok', 'tonase_sertifikat', 'no_sertifikat', 'tg_kadaluarsa', 'label', 'seri_label',]);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'inpmkt'));
    }

    public function form($s)
    {
        $lahan = Datatani::select(
            'id',
            'lapang',
            'no_blok',
            'tonase_sertifikat',
            'no_sertifikat',
            'tg_kadaluarsa',
            'label',
            'seri_label',
            'stok'
            // // Kirim data ke view,
        )->findOrFail($s);
        if (empty($lahan->tonase_sertifikat)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $title = "Input Data pendistribusian";
        return view('mkt-input', compact('title', "lahan"));
    }
    public function post(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->tonase_sertifikat)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }

        // Ambil nilai dari input
        $tb = $request->tb;
        $tm = $request->tm;
        $tp = $request->tp;

        // Ubah ke float, dan fallback ke 0 jika tidak valid
        $tb = is_numeric($tb) ? floatval($tb) : 0;
        $tm = is_numeric($tm) ? floatval($tm) : 0;
        $tp = is_numeric($tp) ? floatval($tp) : 0;

        $lahan->update([
            'bantuan' => $request->bantuan,
            't_bantuan' => $tb,
            'market' => $request->market,
            't_market' => $tm,
            'penangkaran' => $request->penangkaran,
            't_penangkaran' => $tp,
            'stok' => $lahan->tonase_sertifikat - $tb - $tm - $tp,
        ]);
        // dd($lahan);

        //redirect to index
        return redirect()->route('mkt')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function mkt(): View
    {
        $mkt = true;
        $title = "Daftar Data Distribusi";
        $lahans = Datatani::whereNotNull('mutu')->latest()->get([
            'id',
            'lapang',
            'no_blok',
            'bantuan',
            't_bantuan',
            'market',
            't_market',
            'penangkaran',
            't_penangkaran',
            'stok',

        ]);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'mkt'));
    }
}
