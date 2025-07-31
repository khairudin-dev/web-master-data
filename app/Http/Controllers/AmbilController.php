<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AmbilController extends Controller
{
    //
    public function input(): View
    {
        $title = "Input Pengmbilan Sampel";
        $inpabl = true;
        $lahans = Datatani::whereNotNull('tg_p_spl')->whereNull('tg_pengambilan')->latest()->get([
            'id',
            'lapang',
            'no_blok',
            'varietas',
            'panen',
            'luas_akhir',
            'gkp',
            'cbb',
            'tg_p_spl',
            'p_spl',
        ]);
        // // Kirim data ke view
        return view('lahan', compact('title', 'lahans', 'inpabl'));
    }
    public function ambil(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->tg_p_spl)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $request->validate([
            'ambil' => 'required|date_format:d/m/Y|after_or_equal:' . \Carbon\Carbon::parse($lahan->tg_p_spl)->format('d/m/Y'),
        ], [
            "ambil.required" => "Tanggal Permohonan wajib diisi",
            "ambil.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "ambil.after" => "Tanggal Pemantauan harus setelah Tanggal Tanam",
        ]);

        // dd( \Carbon\Carbon::parse($lahan->tg_pl1)->format('d/m/Y') ." ". $request->tg_p);
        // if ($lahan->tg_pl1) {
        //     $request->validate([
        //         'tg_p' => 'required|date_format:d/m/Y|before:' . \Carbon\Carbon::parse($lahan->tg_pl1)->format('d/m/Y'),
        //     ], [
        //         "tg_p.before" => "Tanggal Pemantauan harus sebelum Tanggal Pemantauan Lapang 1",
        //     ]);
        // }
        $pengambilan = $lahan->doc_pengambilan;
        // //check if image is uploaded
        if ($request->hasFile('[permohonan]') or empty($lahan->doc_pengambilan)) {
            $request->validate([
                'permohonan' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            ], [
                "permohonan.required" => "Dokumen Pengambilan wajib diisi",
                'permohonan.mimes' => 'File harus berupa gambar (jpeg, jpg, png) atau PDF',
                "permohonan.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldPengambilan = $pengambilan;
            $pengambilan = "pengambilan sampel-" . $lahan->no_blok . '.pdf';
            $filePengambilan = $request->file('permohonan');
            $ext = strtolower($filePengambilan->getClientOriginalExtension());
            if (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                // Konversi gambar ke PDF
                $imageData = base64_encode(file_get_contents($filePengambilan->getRealPath()));
                $html = '<img src="data:image/' . $ext . ';base64,' . $imageData . '" style="max-width:100%; height:auto;">';

                $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait')->output();
            } elseif ($ext === 'pdf') {
                $pdf = $filePengambilan;
            } else {
                // Antisipasi tidak sesuai, meskipun validasi sudah ada
                return back()->withErrors(['permohonan' => 'Tipe file tidak didukung' . $ext]);
            }
        }
        // dd($hasil. $lahan->blok);

        // dd($request->pendahuluan);
        $lahan->update([
            'tg_pengambilan' => Carbon::createFromFormat('d/m/Y', $request->ambil)->format('Y-m-d'),
            'doc_pengambilan' => $pengambilan,
        ]);


        if ($request->hasFile('permohonan')) {
            //delete old image
            if ($oldPengambilan && Storage::exists('ambil sampel/' . $oldPengambilan)) {
                Storage::delete('ambil sampel/' . $oldPengambilan);
            }
            //upload new image
            try {
                if ($ext === 'pdf') {
                    $request->file('permohonan')->storeAs('ambil sampel', $pengambilan);
                } else {
                    # code...
                    Storage::put('ambil sampel/' . $pengambilan, $pdf);
                }
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file lokasi']);
            }
        }
        //redirect to index
        return redirect()->route('ambil')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function ambil_data(): View
    {
        $title = "Daftar Data pengambilan Sampel";
        $abl = true;
        $lahans = Datatani::whereNotNull('tg_pengambilan')->latest()->get([
            'id',
            'lapang',
            'no_blok',
            'varietas',
            'panen',
            'luas_akhir',
            'gkp',
            'cbb',
            'tg_p_spl',
            'p_spl',
            'tg_pengambilan',
            'doc_pengambilan',
        ]);
        // // Kirim data ke view
        return view('lahan', compact('title', 'lahans', 'abl'));
    }
}
