<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PemantauanController extends Controller
{
    //
    public function lapang(): View
    {
        $inppmt = true;
        $title = "Input Hasil Pemantauan";
        $lahans = Datatani::whereNotNull('lapang')->whereNull('tg_pl3')->latest()->get(['id', 'lapang', 'alamat', 'no_blok', 'nama', 'varietas', 'luas', 'semai', 'tanam']);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'inppmt'));
    }
    public function pemantauan(): View
    {
        $pmt = true;
        $title = "Daftar Hasil Pemantauan";
        $lahans = Datatani::whereNotNull('tg_pendahuluan')->latest()->get(['id', 'lapang', 'nama', 'varietas', 'alamat', 'no_blok', 'tg_pendahuluan', 'tg_pl1', 'tg_pl2', 'tg_pl3']);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'pmt'));
    }
    public function form($s)
    {
        $lahan = Datatani::select(
            'id',
            'no_blok',
            'lapang',
            'varietas',
            'kb',
            'tanam',
            'semai',
            'luas',
            'luas_akhir',
            'i_label',
            'lokasi',
            'tg_pendahuluan',
            'i_pendahuluan',
            'k_pendahuluan',
            's_pendahuluan',
            'h_pendahuluan',
            'tg_pl1',
            'i_pl1',
            'k_pl1',
            's_pl1',
            'h_pl1',
            'tg_pl2',
            'i_pl2',
            'k_pl2',
            's_pl2',
            'h_pl2',
            'tg_pl3',
            'i_pl3',
            'k_pl3',
            's_pl3',
            'h_pl3',
            'taksasi',
        )->findOrFail($s);
        // dd($lahan->semai);
        if (empty($lahan->lapang)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $title = "Input Hasil Pemantauan Lahan";
        return view('pemantauan-input', compact('title', "lahan"));
    }
    public function pendahuluan(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->lapang)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $request->validate([
            'k_p' => 'required',
            's_p' => 'required|numeric|min:0',
            'tg_p' => 'required|date_format:d/m/Y|after:' . \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y'),
        ], [
            "k_p.required" => "Keterangan wajib diisi",
            "s_p.required" => "Isikan 0 jika memang kosong",
            "s_p.min" => "Isikan 0 jika memang kosong",
            "s_p.numeric" => "Luas Lahan spoting wajib diisidengan angkat",
            "tg_p.required" => "Tanggal Pemantauan wajib diisi",
            "tg_p.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "tg_p.after" => "Tanggal Pemantauan harus setelah Tanggal Tanam",
        ]);

        // dd( \Carbon\Carbon::parse($lahan->tg_pl1)->format('d/m/Y') ." ". $request->tg_p);
        if ($lahan->tg_pl1) {
            $request->validate([
                'tg_p' => 'required|date_format:d/m/Y|before:' . \Carbon\Carbon::parse($lahan->tg_pl1)->format('d/m/Y'),
            ], [
                "tg_p.before" => "Tanggal Pemantauan harus sebelum Tanggal Pemantauan Lapang 1",
            ]);
        }
        $pendahuluan = $lahan->i_pendahuluan;
        $hasil = $lahan->h_pendahuluan;
        // //check if image is uploaded
        if ($request->hasFile('pendahuluan') or empty($lahan->i_pendahuluan)) {
            $request->validate([
                'pendahuluan' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                "pendahuluan.required" => "Foto Bukti Pemantauan wajib diisi",
                "pendahuluan.image" => "Harus berupa file gambar", // Allowed extensions
                "pendahuluan.mimes" => "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                "pendahuluan.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldPendahuluan = $pendahuluan;
            $pendahuluan = "pendahuluan-" . $lahan->no_blok . '.' . $request->file('pendahuluan')->getClientOriginalExtension();
        }
        if ($request->hasFile('h_pendahuluan') or empty($lahan->h_pendahuluan)) {
            $request->validate([
                'h_pendahuluan' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            ], [
                "h_pendahuluan.required" => "Dokumen Pemantauan wajib diisi",
                'h_pendahuluan.mimes' => 'File harus berupa gambar (jpeg, jpg, png) atau PDF',
                "h_pendahuluan.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldHasil = $hasil;
            $hasil = "hasil_pendahuluan-" . $lahan->no_blok . '.pdf';
            $fileHasil = $request->file('h_pendahuluan');
            $ext = strtolower($fileHasil->getClientOriginalExtension());
            if (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                // Konversi gambar ke PDF
                $imageData = base64_encode(file_get_contents($fileHasil->getRealPath()));
                $html = '<img src="data:image/' . $ext . ';base64,' . $imageData . '" style="max-width:100%; height:auto;">';

                $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait')->output();
            } elseif ($ext === 'pdf') {
                $pdf = $fileHasil;
            } else {
                // Antisipasi tidak sesuai, meskipun validasi sudah ada
                return back()->withErrors(['h_pendahuluan' => 'Tipe file tidak didukung' . $ext]);
            }
        }
        // dd($hasil. $lahan->blok);

        // dd($request->pendahuluan);
        $lahan->update([
            'k_pendahuluan' => $request->k_p,
            's_pendahuluan' => $request->s_p,
            'tg_pendahuluan' => Carbon::createFromFormat('d/m/Y', $request->tg_p)->format('Y-m-d'),
            'i_pendahuluan' => $pendahuluan,
            'h_pendahuluan' => $hasil,
            'luas_akhir' => $lahan->luas - $request->s_p - $lahan->s_pl1 - $lahan->s_pl2 - $lahan->s_pl3,

        ]);

        if ($request->hasFile('pendahuluan')) {
            //delete old image
            if ($oldPendahuluan && Storage::exists('pendahuluan/' . $oldPendahuluan)) {
                Storage::delete('pendahuluan/' . $oldPendahuluan);
            }
            //upload new image
            try {
                $request->file('pendahuluan')->storeAs('pendahuluan', $pendahuluan);
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file label']);
            }
        }
        if ($request->hasFile('h_pendahuluan')) {
            //delete old image
            if ($oldHasil && Storage::exists('pendahuluan/' . $oldHasil)) {
                Storage::delete('pendahuluan/' . $oldHasil);
            }
            //upload new image
            try {
                if ($ext === 'pdf') {
                    $request->file('h_pendahuluan')->storeAs('pendahuluan', $hasil);
                } else {
                    # code...
                    Storage::put('pendahuluan/' . $hasil, $pdf);
                }
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file lokasi']);
            }
        }
        //redirect to index
        return redirect()->route('pemantauan lapang')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function pl1(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->tg_pendahuluan)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $request->validate([
            'k_pl1' => 'required',
            's_pl1' => 'required|numeric|min:0',
            'tg_pl1' => 'required|date_format:d/m/Y|after:' . \Carbon\Carbon::parse($lahan->tg_pendahuluan)->format('d/m/Y'),
        ], [
            "k_pl1.required" => "Keterangan wajib diisi",
            "s_pl1.required" => "Isikan 0 jika memang kosong",
            "s_pl1.min" => "Isikan 0 jika memang kosong",
            "s_pl1.numeric" => "Luas Lahan spoting wajib diisidengan angkat",
            "tg_pl1.required" => "Tanggal Pemantauan wajib diisi",
            "tg_pl1.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "tg_pl1.after" => "Tanggal Pemantauan harus setelah Tanggal Pendahuluan",
        ]);
        if ($lahan->tg_pl2) {
            $request->validate([
                'tg_pl1' => 'required|date_format:d/m/Y|before:' . \Carbon\Carbon::parse($lahan->tg_pl2)->format('d/m/Y'),
            ], [
                "tg_pl1.before" => "Tanggal Pemantauan harus sebelum Tanggal Pemantauan Lapang 1",
            ]);
        }

        $pl1 = $lahan->i_pl1;
        $hasil = $lahan->h_pl1;
        // //check if image is uploaded
        if ($request->hasFile('pl1') or empty($lahan->i_pl1)) {
            $request->validate([
                'pl1' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                "pl1.required" => "Foto Bukti Pemantauan wajib diisi",
                "pl1.image" => "Harus berupa file gambar", // Allowed extensions
                "pl1.mimes" => "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                "pl1.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldPl1 = $pl1;
            $pl1 = "pl1-" . $lahan->no_blok . '.' . $request->file('pl1')->getClientOriginalExtension();
        }
        if ($request->hasFile('h_pl1') or empty($lahan->h_pl1)) {
            $request->validate([
                'h_pl1' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            ], [
                "h_pl1.required" => "Dokumen Pemantauan wajib diisi",
                'h_pl1.mimes' => 'File harus berupa gambar (jpeg, jpg, png) atau PDF',
                "h_pl1.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldHasil = $hasil;
            $hasil = "hasil_pl1-" . $lahan->no_blok . '.pdf';
            $fileHasil = $request->file('h_pl1');
            $ext = strtolower($fileHasil->getClientOriginalExtension());
            if (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                // Konversi gambar ke PDF
                $imageData = base64_encode(file_get_contents($fileHasil->getRealPath()));
                $html = '<img src="data:image/' . $ext . ';base64,' . $imageData . '" style="max-width:100%; height:auto;">';

                $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait')->output();
            } elseif ($ext === 'pdf') {
                $pdf = $fileHasil;
            } else {
                // Antisipasi tidak sesuai, meskipun validasi sudah ada
                return back()->withErrors(['h_pl1' => 'Tipe file tidak didukung' . $ext]);
            }
        }
        // dd($request->pendahuluan);
        $lahan->update([
            'k_pl1' => $request->k_pl1,
            's_pl1' => $request->s_pl1,
            'tg_pl1' => Carbon::createFromFormat('d/m/Y', $request->tg_pl1)->format('Y-m-d'),
            'i_pl1' => $pl1,
            'h_pl1' => $hasil,
            'luas_akhir' => $lahan->luas - $lahan->s_pendahuluan - $request->s_pl1 - $lahan->s_pl2 - $lahan->s_pl3,

        ]);

        if ($request->hasFile('pl1')) {
            //delete old image
            if ($oldPl1 && Storage::exists('pl1/' . $oldPl1)) {
                Storage::delete('pl1/' . $oldPl1);
            }
            //upload new image
            try {
                $request->file('pl1')->storeAs('pl1', $pl1);
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file label']);
            }
        }
        if ($request->hasFile('h_pl1')) {
            //delete old image
            if ($oldHasil && Storage::exists('pl1/' . $oldHasil)) {
                Storage::delete('pl1/' . $oldHasil);
            }
            //upload new image
            try {
                if ($ext === 'pdf') {
                    $request->file('h_pl1')->storeAs('pl1', $hasil);
                } else {
                    # code...
                    Storage::put('pl1/' . $hasil, $pdf);
                }
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file lokasi']);
            }
        }

        //redirect to index
        return redirect()->route('pemantauan lapang')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function pl2(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->tg_pl1)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $request->validate([
            'k_pl2' => 'required',
            's_pl2' => 'required|numeric|min:0',
            'tg_pl2' => 'required|date_format:d/m/Y|after:' . \Carbon\Carbon::parse($lahan->tg_pl1)->format('d/m/Y'),
        ], [
            "k_pl2.required" => "Keterangan wajib diisi",
            "s_pl2.required" => "Isikan 0 jika memang kosong",
            "s_pl2.min" => "Isikan 0 jika memang kosong",
            "s_pl2.numeric" => "Luas Lahan spoting wajib diisidengan angkat",
            "tg_pl2.required" => "Tanggal Pemantauan wajib diisi",
            "tg_pl2.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "tg_pl2.after" => "Tanggal Pemantauan harus setelah Tanggal Pemantauan Lapang 1",
        ]);

        if ($lahan->tg_pl3) {
            $request->validate([
                'tg_pl2' => 'required|date_format:d/m/Y|before:' . \Carbon\Carbon::parse($lahan->tg_pl3)->format('d/m/Y'),
            ], [
                "tg_pl2.before" => "Tanggal Pemantauan harus sebelum Tanggal Pemantauan Lapang 3",
            ]);
        }

        $pl2 = $lahan->i_pl2;
        $hasil = $lahan->h_pl2;

        // //check if image is uploaded
        if ($request->hasFile('pl2') or empty($lahan->i_pl2)) {
            $request->validate([
                'pl2' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                "pl2.required" => "Foto Bukti Pemantauan wajib diisi",
                "pl2.image" => "Harus berupa file gambar", // Allowed extensions
                "pl2.mimes" => "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                "pl2.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldPl2 = $pl2;
            $pl2 = "pl2-" . $lahan->no_blok . '.' . $request->file('pl2')->getClientOriginalExtension();
        }
        if ($request->hasFile('h_pl2') or empty($lahan->h_pl2)) {
            $request->validate([
                'h_pl2' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            ], [
                "h_pl2.required" => "Dokumen Pemantauan wajib diisi",
                'h_pl2.mimes' => 'File harus berupa gambar (jpeg, jpg, png) atau PDF',
                "h_pl2.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldHasil = $hasil;
            $hasil = "hasil_pl2-" . $lahan->no_blok . '.pdf';
            $fileHasil = $request->file('h_pl2');
            $ext = strtolower($fileHasil->getClientOriginalExtension());
            if (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                // Konversi gambar ke PDF
                $imageData = base64_encode(file_get_contents($fileHasil->getRealPath()));
                $html = '<img src="data:image/' . $ext . ';base64,' . $imageData . '" style="max-width:100%; height:auto;">';

                $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait')->output();
            } elseif ($ext === 'pdf') {
                $pdf = $fileHasil;
            } else {
                // Antisipasi tidak sesuai, meskipun validasi sudah ada
                return back()->withErrors(['h_pl2' => 'Tipe file tidak didukung' . $ext]);
            }
        }

        // dd($request->pendahuluan);
        $lahan->update([
            'k_pl2' => $request->k_pl2,
            's_pl2' => $request->s_pl2,
            'tg_pl2' => Carbon::createFromFormat('d/m/Y', $request->tg_pl2)->format('Y-m-d'),
            'i_pl2' => $pl2,
            'h_pl2' => $hasil,
            'luas_akhir' => $lahan->luas - $lahan->s_pendahuluan - $lahan->s_pl1 - $request->s_pl2 - $lahan->s_pl3,

        ]);

        if ($request->hasFile('pl2')) {
            //delete old image
            if ($oldPl2 && Storage::exists('pl2/' . $oldPl2)) {
                Storage::delete('pl2/' . $oldPl2);
            }
            //upload new image
            try {
                $request->file('pl2')->storeAs('pl2', $pl2);
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file label']);
            }
        }
        if ($request->hasFile('h_pl2')) {
            //delete old image
            if ($oldHasil && Storage::exists('pl2/' . $oldHasil)) {
                Storage::delete('pl2/' . $oldHasil);
            }
            //upload new image
            try {
                if ($ext === 'pdf') {
                    $request->file('h_pl2')->storeAs('pl2', $hasil);
                } else {
                    # code...
                    Storage::put('pl2/' . $hasil, $pdf);
                }
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file lokasi']);
            }
        }

        //redirect to index
        return redirect()->route('pemantauan lapang')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function pl3(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        if (empty($lahan->tg_pl2)) {
            return redirect()->back()->with(['error' => 'Kamu memasukkan lahan yang salah']);
        }
        $request->validate([
            'k_pl3' => 'required',
            's_pl3' => 'required|numeric|min:0',
            'tg_pl3' => 'required|date_format:d/m/Y|after:' . \Carbon\Carbon::parse($lahan->tg_pl2)->format('d/m/Y'),
            'tk' => 'required|numeric|min:0',
        ], [
            "k_pl3.required" => "Keterangan wajib diisi",
            "s_pl3.required" => "Isikan 0 jika memang kosong",
            "s_pl3.min" => "Isikan 0 jika memang kosong",
            "s_pl3.numeric" => "Luas Lahan spoting wajib diisidengan angkat",
            "tg_pl3.required" => "Tanggal Pemantauan wajib diisi",
            "tg_pl3.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "tg_pl3.after" => "Tanggal Pemantauan harus setelah Tanggal Pemantauan Lapang 2",
            "tk.required" => "Isikan 0 jika memang kosong",
            "tk.min" => "Isikan 0 jika memang kosong",
            "tk.numeric" => "Taksasi wajib diisidengan angkat",
        ]);

        $pl3 = $lahan->i_pl3;
        $hasil = $lahan->h_pl3;

        // //check if image is uploaded
        if ($request->hasFile('pl3') or empty($lahan->i_pl3)) {
            $request->validate([
                'pl3' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                "pl3.required" => "Foto Bukti Pemantauan wajib diisi",
                "pl3.image" => "Harus berupa file gambar", // Allowed extensions
                "pl3.mimes" => "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                "pl3.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldPl3 = $pl3;
            $pl3 = "pl3-" . $lahan->no_blok . '.' . $request->file('pl3')->getClientOriginalExtension();
        }
        if ($request->hasFile('h_pl3') or empty($lahan->h_pl3)) {
            $request->validate([
                'h_pl3' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            ], [
                "h_pl3.required" => "Dokumen Pemantauan wajib diisi",
                'h_pl3.mimes' => 'File harus berupa gambar (jpeg, jpg, png) atau PDF',
                "h_pl3.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldHasil = $hasil;
            $hasil = "hasil_pl3-" . $lahan->no_blok . '.pdf';
            $fileHasil = $request->file('h_pl3');
            $ext = strtolower($fileHasil->getClientOriginalExtension());
            if (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                // Konversi gambar ke PDF
                $imageData = base64_encode(file_get_contents($fileHasil->getRealPath()));
                $html = '<img src="data:image/' . $ext . ';base64,' . $imageData . '" style="max-width:100%; height:auto;">';

                $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait')->output();
            } elseif ($ext === 'pdf') {
                $pdf = $fileHasil;
            } else {
                // Antisipasi tidak sesuai, meskipun validasi sudah ada
                return back()->withErrors(['h_pl3' => 'Tipe file tidak didukung' . $ext]);
            }
        }

        // dd($request->pendahuluan);
        $lahan->update([
            'k_pl3' => $request->k_pl3,
            's_pl3' => $request->s_pl3,
            'tg_pl3' => Carbon::createFromFormat('d/m/Y', $request->tg_pl3)->format('Y-m-d'),
            'i_pl3' => $pl3,
            'h_pl3' => $hasil,
            'taksasi'=>$request->tk,
            'luas_akhir' => $lahan->luas - $lahan->s_pendahuluan - $lahan->s_pl1 - $lahan->s_pl2 - $request->s_pl3,

        ]);

        if ($request->hasFile('pl3')) {
            //delete old image
            if ($oldPl3 && Storage::exists('pl3/' . $oldPl3)) {
                Storage::delete('pl3/' . $oldPl3);
            }
            //upload new image
            try {
                $request->file('pl3')->storeAs('pl3', $pl3);
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file label']);
            }
        }
        if ($request->hasFile('h_pl3')) {
            //delete old image
            if ($oldHasil && Storage::exists('pl3/' . $oldHasil)) {
                Storage::delete('pl3/' . $oldHasil);
            }
            //upload new image
            try {
                if ($ext === 'pdf') {
                    $request->file('h_pl3')->storeAs('pl3', $hasil);
                } else {
                    # code...
                    Storage::put('pl3/' . $hasil, $pdf);
                }
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file lokasi']);
            }
        }

        //redirect to index
        return redirect()->route('pemantauan lapang')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
