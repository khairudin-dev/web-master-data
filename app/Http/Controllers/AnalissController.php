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
        $lahans = Datatani::whereNotNull('tg_pengambilan')->whereNull('mutu')->latest()->get(['id','tg_pengambilan', 'lapang','varietas', 'no_blok', 'panen', 'lulus', "tonase", 'taksasi']);
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
            'bm',
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
            'lulus',
            'tg_pengambilan',
            'tg_selesai',
            'ka',
            'kecambah',
            'bm',
            'mutu',
            'no_sertifikat',
            'seri_label',
            'tg_kadaluarsa',
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
        $request->validate([
            // 'seri' => 'required',
            'lab' => 'required',
            // 'sertif' => 'required',
            'ka' => 'required|numeric|min:0',
            'dk' => 'required|numeric|min:0',
            'bm' => 'required|numeric|min:0',
            // 'ambil'=> 'required|date_format:d/m/Y',
            'selesai'=> 'required|date_format:d/m/Y|after:ambil',
        ], [
            // "ambil.required"=>"Tanggal Pengambilan wajib diisi",
            // "ambil.date_format"=>"Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "selesai.required"=>"Tanggal Selesai wajib diisi",
            "selesai.date_format"=>"Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "selesai.after"=>"Tanggal Selesai harus sesudah Tanggal Pengambilan",
            "ka.required"=>"Kadar Air wajib diisi, isi 0 jika memang kosong",
            "ka.numeric"=>"harus dengan angkat",
            "dk.required"=>"Daya berKecambah wajib diisi, isi 0 jika memang kosong",
            "dk.numeric"=>"harus dengan angkat",
            "bm.required"=>"Benih Murni wajib diisi, isi 0 jika memang kosongbm",
            "bm.numeric"=>"harus dengan angkat",
            "lab.required"=>"Hasil Uji wajib diisi",  
            // "sertif.required"=>"Nomor sertifikat wajib diisi",  
            // "seri.required"=>"Nomor seri wajib diisi",  
        ]);

        // dd(Carbon::createFromFormat('d/m/Y', $request->selesai)->copy()->addMonths(6)->format('Y-m-d'));
        $lahan->update([
            // 'tg_pengambilan' => Carbon::createFromFormat('d/m/Y', $request->ambil)->format('Y-m-d'),
            'tg_selesai' => Carbon::createFromFormat('d/m/Y', $request->selesai)->format('Y-m-d'),
            'ka' => $request->ka,
            'kecambah' => $request->dk,
            'mutu' => $request->lab,
            'tonase_sertifikat' => $lahan->tonase,
            'stok' => $lahan->tonase,
            // 'no_sertifikat' => $request->sertif,
            'tg_kadaluarsa' => Carbon::createFromFormat('d/m/Y', $request->selesai)->copy()->addMonths(6)->format('Y-m-d'),
            'label' =>  $lahan->tonase/5,
            // 'seri_label' =>  $request->seri,
            'bm' =>  $request->bm,
        ]);

        //redirect to index
        return redirect()->route('lab')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
