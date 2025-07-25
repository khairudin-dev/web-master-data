<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SampelController extends Controller
{
    public function input(): View
    {
        $title = "Input Permohonan Ambil Sampel";
        $inpspl = true;
        $lahans = Datatani::whereNotNull('gkp')->whereNull('tg_p_spl')->latest()->get([
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
        return view('lahan', compact('title', 'lahans', 'inpspl'));
    }
    public function sampel(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->gkp)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $request->validate([
            'sampel' => 'required|date_format:d/m/Y|after:' . \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y'),
        ], [
            "sampel.required" => "Tanggal Permohonan wajib diisi",
            "sampel.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "sampel.after" => "Tanggal Pemantauan harus setelah Tanggal Tanam",
        ]);

        // dd( \Carbon\Carbon::parse($lahan->tg_pl1)->format('d/m/Y') ." ". $request->tg_p);
        // if ($lahan->tg_pl1) {
        //     $request->validate([
        //         'tg_p' => 'required|date_format:d/m/Y|before:' . \Carbon\Carbon::parse($lahan->tg_pl1)->format('d/m/Y'),
        //     ], [
        //         "tg_p.before" => "Tanggal Pemantauan harus sebelum Tanggal Pemantauan Lapang 1",
        //     ]);
        // }
        $permohonan = $lahan->p_spl;
        // //check if image is uploaded
        if ($request->hasFile('permohonan') or empty($lahan->p_spl)) {
            $request->validate([
                'permohonan' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            ], [
                "permohonan.required" => "Dokumen Pemantauan wajib diisi",
                'permohonan.mimes' => 'File harus berupa gambar (jpeg, jpg, png) atau PDF',
                "permohonan.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldPermohonan = $permohonan;
            $permohonan = "permohonan ambil sampel-" . $lahan->no_blok . '.pdf';
            $filePermohonan = $request->file('permohonan');
            $ext = strtolower($filePermohonan->getClientOriginalExtension());
            if (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                // Konversi gambar ke PDF
                $imageData = base64_encode(file_get_contents($filePermohonan->getRealPath()));
                $html = '<img src="data:image/' . $ext . ';base64,' . $imageData . '" style="max-width:100%; height:auto;">';

                $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait')->output();
            } elseif ($ext === 'pdf') {
                $pdf = $filePermohonan;
            } else {
                // Antisipasi tidak sesuai, meskipun validasi sudah ada
                return back()->withErrors(['permohonan' => 'Tipe file tidak didukung' . $ext]);
            }
        }
        // dd($hasil. $lahan->blok);

        // dd($request->pendahuluan);
        $lahan->update([
            'tg_p_spl' => Carbon::createFromFormat('d/m/Y', $request->sampel)->format('Y-m-d'),
            'p_spl' => $permohonan,
        ]);


        if ($request->hasFile('permohonan')) {
            //delete old image
            if ($oldPermohonan && Storage::exists('ambil sampel/' . $oldPermohonan)) {
                Storage::delete('ambil sampel/' . $oldPermohonan);
            }
            //upload new image
            try {
                if ($ext === 'pdf') {
                    $request->file('permohonan')->storeAs('ambil sampel', $permohonan);
                } else {
                    # code...
                    Storage::put('ambil sampel/' . $permohonan, $pdf);
                }
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file lokasi']);
            }
        }
        //redirect to index
        return redirect()->route('sampel')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function sampel_data(): View
    {
        $title = "Daftar Data Permohonan Ambil Sampel";
        $spl = true;
        $lahans = Datatani::whereNotNull('tg_p_spl')->latest()->get([
            'id',
            'lapang',
            'no_blok',
            'varietas',
            'panen',
            // 'taksasi',
            // 'tonase',
            'luas_akhir',
            'gkp',
            'cbb',
            'tg_p_spl',
            'p_spl',

        ]);
        // // Kirim data ke view
        return view('lahan', compact('title', 'lahans', 'spl'));
    }
}
