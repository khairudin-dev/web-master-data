<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnalissController extends Controller
{
    public function lapang(): View
    {
        $inplab = true;
        $title = "Input Hasil Uji Laboratorium";
        $lahans = Datatani::whereNotNull('panen')->latest()->get(['id', 'lapang', 'no_blok', 'panen', 'lulus', "tonase", 'taksasi']);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'inplab'));
    }
        public function lab(): View
    {
        $lab = true;
        $title = "Daftar Hasil Uji Laboratorium";
        $lahans = Datatani::whereNotNull('mutu')->latest()->get([
            'id',
            'lapang',
            'no_blok',
            'ka',
            'kecambah',
            'mutu',
            'tonase_sertifikat',
            'no_sertifikat',
            'tg_kadaluarsa',
            'label',
            'seri_label',
        ]);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'lab'));
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
    public function post(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->tg_pl3)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        // $request->validate([
        //     'k_p' => 'required',
        //     's_p' => 'required|numeric|min:0',
        //     'tg_p' => 'required|date_format:d/m/Y',
        // ], [
        //     "k_p.required" => "Keterangan wajib diisi",
        //     "s_p.required" => "Isikan 0 jika memang kosong",
        //     "s_p.min" => "Isikan 0 jika memang kosong",
        //     "s_p.numeric" => "Luas Lahan spoting wajib diisidengan angkat",
        //     "tg_p.required" => "Tanggal Pemantauan wajib diisi",
        //     "tg_p.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
        //     // "tanam.after" => "Tanggal Tanam harus setelah Tanggal Semai",
        // ]);

        // $panen = Carbon::createFromFormat('d/m/Y', $request->panen)->startOfDay();
        // $semai = Carbon::parse($lahan->semai)->startOfDay();
        // $selisih = $semai->diffInDays($panen, false); // false agar bisa hasil negatif juga

        // Tambahkan 6 bulan
        // $tanggalTambah6Bulan = $tanggal->copy()->addMonths(6);

        // dd(Carbon::createFromFormat('d/m/Y', $request->selesai)->copy()->addMonths(6)->format('Y-m-d'));
        $lahan->update([
            'tg_pengambilan' => Carbon::createFromFormat('d/m/Y', $request->ambil)->format('Y-m-d'),
            'tg_selesai' => Carbon::createFromFormat('d/m/Y', $request->selesai)->format('Y-m-d'),
            'ka' => $request->ka,
            'kecambah' => $request->dk,
            'mutu' => $request->lab,
            'tonase_sertifikat' => $lahan->tonase,
            'no_sertifikat' => $request->sertif,
            'tg_kadaluarsa' => Carbon::createFromFormat('d/m/Y', $request->selesai)->copy()->addMonths(6)->format('Y-m-d'),
            'label' =>  $lahan->tonase/5,
            'seri_label' =>  $request->seri,
        ]);

        //redirect to index
        return redirect()->route('lab')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
