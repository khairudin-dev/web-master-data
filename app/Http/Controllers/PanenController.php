<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PanenController extends Controller
{
    //
    public function lapang(): View
    {
        $inppn = true;
        $title = "Input Hasil Panen";
        $lahans = Datatani::whereNotNull('tg_pl3')->whereNull('panen')->latest()->get([
            'id',
            'nama',
            'alamat',
            'lapang',
            'no_blok',
            'kb',
            'varietas',
            'luas',
            'luas_akhir',
            'semai',
            'tanam'
        ]);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'inppn'));
    }
    public function panen(): View
    {
        $pn = true;
        $title = "Daftar Hasil Panen";
        $lahans = Datatani::whereNotNull('panen')->latest()->get([
            'id',
            'lapang',
            'nama',
            'alamat',
            'no_blok',
            'panen',
            'taksasi',
            'varietas',
            'tonase',
            'lulus',
        ]);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'pn'));
    }
    public function form($s)
    {
        $lahan = Datatani::select(
            'id',
            'no_blok',
            'lapang',
            'varietas',
            'kb',
            'semai',
            'tanam',
            'luas',
            'luas_akhir',
            'i_label',
            'tg_pl3',
            'taksasi',
            'umur_padi',
            'tonase_sertifikat',
        )->findOrFail($s);
        if (empty($lahan->tg_pl3)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $title = "Input Hasil Panen Lahan";
        return view('panen-input', compact('title', "lahan"));
    }
    public function post(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->tg_pl3)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $request->validate([
            'tk' => 'required|numeric|min:0',
            'panen' => 'required|date_format:d/m/Y|after:' . \Carbon\Carbon::parse($lahan->tg_pl3)->format('d/m/Y'),

        ], [
            "tk.required" => "Isikan 0 jika memang kosong",
            "tk.min" => "Isikan 0 jika memang kosong",
            "tk.numeric" => "Luas Lahan Taksasi wajib diisidengan angkat",
            "panen.required" => "Tanggal Panen wajib diisi",
            "panen.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "tg_p.after" => "Tanggal Panen harus setelah Tanggal Pemantauan Lapang 3",
        ]);

        $panen = Carbon::createFromFormat('d/m/Y', $request->panen)->startOfDay();
        $semai = Carbon::parse($lahan->semai)->startOfDay();
        $selisih = $semai->diffInDays($panen, false); // false agar bisa hasil negatif juga

        // dd($request->pendahuluan);
        $lahan->update([
            'panen' => Carbon::createFromFormat('d/m/Y', $request->panen)->format('Y-m-d'),
            'taksasi' => $request->tk,
            'tonase' => $request->tk * $lahan->luas_akhir,
            'lulus' => $lahan->luas_akhir,
            'umur_padi' => $selisih,
        ]);

        //redirect to index
        return redirect()->route('panen')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
