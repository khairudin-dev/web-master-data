<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RegisLahanController extends Controller
{
    //

    public function lahan(): View
    {
        $title = "Daftar Lahan";
        $lhn = true;
        $lahans = Datatani::latest()->get(['id', 'no_blok', 'nama', 'varietas', 'alamat', 'luas', 'semai', 'tanam']);
        // // Kirim data ke 
        // dd($lahans);
        return view('lahan', compact('title', 'lahans', 'lhn'));
    }
    public function rsgis_page(): View
    {
        $title = "Registrasi Lahan Baru";
        //Baca isi file JSON (misal tanpa ID, cukup nama)
        $jsonString = Storage::disk('data')->get('wilayah.json');
        $wilayah = json_decode($jsonString, true);
        $jsonString = Storage::disk('data')->get('m_data.json');
        $dataForm = json_decode($jsonString, true);
        // // Kirim data ke view
        return view('regis-lahan', compact('wilayah', 'title', 'dataForm'));
    }

    // public function regis(Request $request): RedirectResponse
    public function regis(Request $request): RedirectResponse
    {

        //validate form
        $request->validate([
            'blok' => 'required|unique:datatanis,no_blok',
            'nama' => 'required|min:3',
            'alamat' => 'required|not_regex:/,/',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'varietas' => 'required',
            'kb' => 'required',
            'musim' => 'required',
            'label' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'lokasi' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'permohonan' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            'sumber' => 'required|min:3',
            'luas' => 'required|numeric|min:0.1',
            'semai' => 'required|date_format:d/m/Y|before:tanam',
            'tanam' => 'required|date_format:d/m/Y|after:semai',
        ], [
            "blok.required" => "Nomor Blok wajib diisi",
            "blok.unique" => "Nomor Blok sudah digunakan",
            "nama.required" => "Nama wajib diisi",
            "nama.min" => "Nama minimal 3 karakter",
            "alamat.required" => "Alamat wajib diisi",
            "alamat.min" => "Alamat minimal 16 karakter",
            'alamat.not_regex' => 'Alamat tidak boleh mengandung tanda koma (,).',
            "provinsi.required" => "Provinsi wajib diisi",
            "kota.required" => "Kota / Kabupaten wajib diisi",
            "kecamatan.required" => "Kecamatan wajib diisi",
            "desa.required" => "Desa / Kelurahan wajib diisi",
            "varietas.required" => "Varietas wajib diisi",
            "kb.required" => "Kualitas Benih wajib diisi",
            "musim.required" => "Musim Tanam wajib diisi",
            "label.required" => "Foto Label wajib diisi",
            "label.image" => "Harus berupa file gambar", // Allowed extensions
            "label.mimes" => "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
            "label.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            "lokasi.required" => "Foto Lokasi wajib diisi",
            "lokasi.image" => "Harus berupa file gambar", // Allowed extensions
            "lokasi.mimes" => "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
            "lokasi.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            "permohonan.required" => "Dokumen permohonan wajib diisi",
            'permohonan.mimes' => 'File harus berupa gambar (jpeg, jpg, png) atau PDF',
            "permohonan.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            "sumber.required" => "Label Sumber wajib diisi",
            "sumber.min" => "Label Sumber minimal 3 karakter",
            "luas.required" => "Luas Lahan wajib diisi",
            "luas.min" => "Luas Lahan minimal 0.1 ha",
            "semai.required" => "Tanggal Semai wajib diisi",
            "semai.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "semai.before" => "Tanggal Semai harus sebelum Tanggal Tanam",
            "tanam.required" => "Tanggal Tanam wajib diisi",
            "tanam.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "tanam.after" => "Tanggal Tanam harus setelah Tanggal Semai",
        ]);

        $label = "label-" . $request->blok . '.' . $request->file('label')->getClientOriginalExtension();
        $lokasi = "lokasi-" . $request->blok . '.' . $request->file('lokasi')->getClientOriginalExtension();
        $permohonan = "permohonan-" . $request->blok . '.pdf';

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


        //create product
        $store = Datatani::create([
            'no_blok' => $request->blok,
            'nama' => $request->nama,
            'varietas' => $request->varietas,
            'kb' => $request->kb,
            'musim' => $request->musim,
            'alamat' => $request->alamat . ", " . $request->desa . ", " . $request->kecamatan . ", " . $request->kota . ", " . $request->provinsi,
            'lokasi' => $lokasi,
            "i_label" => $label,
            "label_sumber" => $request->sumber,
            "semai" => Carbon::createFromFormat('d/m/Y', $request->semai)->format('Y-m-d'),
            "tanam" => Carbon::createFromFormat('d/m/Y', $request->tanam)->format('Y-m-d'),
            "luas" => $request->luas,
            "luas_akhir" => $request->luas,
            'permohonan' => $permohonan,
        ]);
        if ($store) {
            $request->file('label')->storeAs('label', $label);
            $request->file('lokasi')->storeAs('lokasi', $lokasi);
            if ($ext === 'pdf') {
                $request->file('permohonan')->storeAs('permohonan', $permohonan);
            } else {
                # code...
                Storage::put('permohonan/' . $permohonan, $pdf);
            }
        }
        //redirect to index
        // dd($data);
        return redirect()->route('lahan')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit_page($s): View
    {
        $edit = true;
        $title = "Edit Data Lahan";
        $lahan = Datatani::select('id', 'no_blok', 'nama', 'alamat', 'varietas', 'kb', 'musim', 'lokasi', 'i_label', 'label_sumber', 'semai', 'tanam', 'luas', 'permohonan')->findOrFail($s);
        //Baca isi file JSON (misal tanpa ID, cukup nama)
        $jsonString = Storage::disk('data')->get('wilayah.json');
        $wilayah = json_decode($jsonString, true);
        $jsonString = Storage::disk('data')->get('m_data.json');
        $dataForm = json_decode($jsonString, true);
        // // Kirim data ke view
        // dd($lahan);
        return view('regis-lahan', compact('wilayah', 'title', 'dataForm', "lahan", 'edit'));
    }

    public function update(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        $request->validate([
            'blok' => 'required|unique:datatanis,no_blok,' . $s,
            'nama' => 'required|min:3',
            'alamat' => 'required|not_regex:/,/',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'varietas' => 'required',
            'kb' => 'required',
            'musim' => 'required',
            'sumber' => 'required|min:3',
            'luas' => 'required|numeric|min:0.1',
            'semai' => 'required|date_format:d/m/Y|before:tanam',
            'tanam' => 'required|date_format:d/m/Y|after:semai',
        ], [
            "blok.required" => "Nomor Blok wajib diisi",
            "blok.unique" => "Nomor Blok sudah digunakan",
            "nama.required" => "Nama wajib diisi",
            "nama.min" => "Nama minimal 3 karakter",
            "alamat.required" => "Alamat wajib diisi",
            "alamat.min" => "Alamat minimal 16 karakter",
            'alamat.not_regex' => 'Alamat tidak boleh mengandung tanda koma (,).',
            "provinsi.required" => "Provinsi wajib diisi",
            "kota.required" => "Kota / Kabupaten wajib diisi",
            "kecamatan.required" => "Kecamatan wajib diisi",
            "desa.required" => "Desa / Kelurahan wajib diisi",
            "varietas.required" => "Varietas wajib diisi",
            "kb.required" => "Kualitas Benih wajib diisi",
            "musim.required" => "Musim Tanam wajib diisi",
            "sumber.required" => "Label Sumber wajib diisi",
            "sumber.min" => "Label Sumber minimal 3 karakter",
            "luas.required" => "Luas Lahan wajib diisi",
            "luas.min" => "Luas Lahan minimal 0.1 ha",
            "semai.required" => "Tanggal Semai wajib diisi",
            "semai.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "semai.before" => "Tanggal Semai harus sebelum Tanggal Tanam",
            "tanam.required" => "Tanggal Tanam wajib diisi",
            "tanam.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "tanam.after" => "Tanggal Tanam harus setelah Tanggal Semai",
        ]);

        $label = $lahan->i_label;
        $lokasi = $lahan->lokasi;
        $permohonan = $lahan->permohonan;
        // //check if image is uploaded
        if ($request->hasFile('label')) {
            $request->validate([
                'label' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                "label.required" => "Foto Label wajib diisi",
                "label.image" => "Harus berupa file gambar", // Allowed extensions
                "label.mimes" => "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                "label.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldLabel = $label;
            $label = "label-" . $request->blok . '.' . $request->file('label')->getClientOriginalExtension();
        }
        if ($request->hasFile('lokasi')) {
            $request->validate([
                'lokasi' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                "lokasi.required" => "Foto Lokasi wajib diisi",
                "lokasi.image" => "Harus berupa file gambar", // Allowed extensions
                "lokasi.mimes" => "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                "lokasi.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldLokasi = $lokasi;
            $lokasi = "lokasi-" . $request->blok . '.' . $request->file('lokasi')->getClientOriginalExtension();
        }
        if ($request->hasFile('permohonan')) {
            $request->validate([
                'permohonan' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            ], [
                "permohonan.required" => "Dokumen permohonan wajib diisi",
                'permohonan.mimes' => 'File harus berupa gambar (jpeg, jpg, png) atau PDF',
                "permohonan.max" => "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
            ]);
            $oldPermohonan = $permohonan;
            $permohonan = "permohonan-" . $request->blok . '.pdf';
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
        // dd($request->nama);
        $lahan->update([
            'no_blok' => $request->blok,
            'nama' => $request->nama,
            'varietas' => $request->varietas,
            'kb' => $request->kb,
            'musim' => $request->musim,
            'alamat' => $request->alamat . ", " . $request->desa . ", " . $request->kecamatan . ", " . $request->kota . ", " . $request->provinsi,
            'lokasi' => $lokasi,
            'permohonan' => $permohonan,
            "i_label" => $label,
            "label_sumber" => $request->sumber,
            "semai" => Carbon::createFromFormat('d/m/Y', $request->semai)->format('Y-m-d'),
            "tanam" => Carbon::createFromFormat('d/m/Y', $request->tanam)->format('Y-m-d'),
            "luas" => $request->luas,
            "luas_akhir" => $request->luas - $lahan->s_pendahuluan - $lahan->s_pl1 - $lahan->s_pl2 - $lahan->s_pl3,
        ]);

        if ($request->hasFile('label')) {
            //delete old image
            if ($oldLabel && Storage::exists('label/' . $oldLabel)) {
                Storage::delete('label/' . $oldLabel);
            }
            //upload new image
            try {
                $request->file('label')->storeAs('label', $label);
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file label']);
            }
        }
        if ($request->hasFile('lokasi')) {
            //delete old image
            if ($oldLokasi && Storage::exists('lokasi/' . $oldLokasi)) {
                Storage::delete('lokasi/' . $oldLokasi);
            }
            //upload new image
            try {
                $request->file('lokasi')->storeAs('lokasi', $lokasi);
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file lokasi']);
            }
        }
        if ($request->hasFile('permohonan')) {
            //delete old image
            if ($oldPermohonan && Storage::exists('permohonan/' . $oldPermohonan)) {
                Storage::delete('permohonan/' . $oldPermohonan);
            }
            //upload new image
            try {
                if ($ext === 'pdf') {
                    $request->file('permohonan')->storeAs('permohonan', $permohonan);
                } else {
                    # code...
                    Storage::put('permohonan/' . $permohonan, $pdf);
                }
            } catch (\Exception $e) {
                // Opsional: rollback DB atau log error
                return redirect()->back()->with(['error' => 'Gagal simpan file lokasi']);
            }
        }

        //redirect to index
        return redirect()->route('lahan')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function delete($s): RedirectResponse
    {
        //get product by ID
        $lahan = Datatani::findOrFail($s);

        $label = $lahan->i_label;
        $lokasi = $lahan->lokasi;

        //delete product
        $lahan->delete();
        //delete image
        Storage::delete('label/' . $label);
        Storage::delete('lokasi/' . $lokasi);


        //redirect to index
        return redirect()->route('lahan')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
