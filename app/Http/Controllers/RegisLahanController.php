<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
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
        $lahans = Datatani::latest()->get(['no_blok', 'nama', 'lokasi', 'luas', 'semai', 'tanam']);
        // // Kirim data ke view
        return view('lahan', compact('title', 'lahans'));
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
            'blok' => 'required|min:10|unique:datatanis,no_blok',
            'nama' => 'required|min:3',
            'alamat' => 'required|min:16|not_regex:/,/',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'varietas' => 'required',
            'kb' => 'required',
            'musim' => 'required',
            'label' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'sumber' => 'required|min:3',
            'luas' => 'required|numeric|min:0.1',
            'semai' => 'required|date_format:d/m/Y|before:tanam',
            'tanam' => 'required|date_format:d/m/Y|after:semai',
        ], [
            "blok.required" => "Nomor Blok wajib diisi",
            "blok.unique" => "Nomor Blok sudah digunakan",
            "blok.min" => "Nomor Blok minimal 10 karakter",
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
            "sumber.required" => "Label Sumber wajib diisi",
            "sumber.min" => "Label Sumber minimal 3 karakter",
            "luas.required" => "Luas Lahan wajib diisi",
            "luas.min" => "Luas Lahan minimal 0.1 ha",
            "semai.required" => "Tanggal Semai wajib diisi",
            "semai.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "semai.before" => "Tanggal Semai harus sebelum Tanggal Tanam",
            "tanam.required" => "Tanggal Tanam wajib diisi",
            "semai.date_format" => "Isian wajib berupa tanggal! (HH/BB/TTTT)",
            "semai.after" => "Tanggal Tanam harus setelah Tanggal Semai",
        ]);
        $lokasi = $request->alamat . ", " . $request->desa . ", " . $request->kecamatan . ", " . $request->kota . ", " . $request->provinsi;
        if (!$request->has('sm_dg')) {
            $request->validate([
                'lokasi' => 'required|min:16|not_regex:/,/',
                'l_provinsi' => 'required',
                'l_kota' => 'required',
                'l_kecamatan' => 'required',
                'l_desa' => 'required',
            ], [
                "lokasi.required" => "Lokasi wajib diisi",
                'lokasi.not_regex' => 'Lokasi tidak boleh mengandung tanda koma (,).',
                "lokasi.min" => "Lokasi minimal 16 karakter",
                "l_provinsi.required" => "Provinsi wajib diisi",
                "l_kota.required" => "Kota / Kabupaten wajib diisi",
                "l_kecamatan.required" => "Kecamatan wajib diisi",
                "l_desa.required" => "Desa / Kelurahan wajib diisi",
            ]);
            $lokasi = $request->lokasi . ", " . $request->l_desa . ", " . $request->l_kecamatan . ", " . $request->l_kota . ", " . $request->l_provinsi;
        }
        $image = "label-" . $request->blok . '.' . $request->file('label')->getClientOriginalExtension();

        //create product
        $store = Datatani::create([
            'no_blok' => $request->blok,
            'nama' => $request->nama,
            'varietas' => $request->varietas,
            'kb' => $request->kb,
            'musim' => $request->musim,
            'alamat' => $request->alamat . ", " . $request->desa . ", " . $request->kecamatan . ", " . $request->kota . ", " . $request->provinsi,
            'lokasi' => $lokasi,
            "i_label" => $image,
            "label_sumber" => $request->sumber,
            "semai" => Carbon::createFromFormat('d/m/Y', $request->semai)->format('Y-m-d'),
            "tanam" => Carbon::createFromFormat('d/m/Y', $request->tanam)->format('Y-m-d'),
            "luas" => $request->luas,
        ]);
        if ($store) {
            $request->file('label')->storeAs('label', $image);
        }
        //redirect to index
        // dd($data);
        return redirect()->route('regis lahan')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function getDetail($no_blok): Response
    {
        $lahan = Datatani::select('id', 'no_blok', 'nama', 'alamat', 'varietas', 'kb', 'musim', 'lokasi', 'i_label', 'label_sumber', 'semai', 'tanam', 'luas')->where('no_blok', $no_blok)->firstOrFail();
        // dd($lahan);
        return response()->view('partials.detail-lahan', compact('lahan'));
    }

    public function edit_page($s): View
    {
        $edit = true;
        $title = "Edit Data Lahan";
        $lahan = Datatani::select('id', 'no_blok', 'nama', 'alamat', 'varietas', 'kb', 'musim', 'lokasi', 'i_label', 'label_sumber', 'semai', 'tanam', 'luas')->findOrFail($s);
        //Baca isi file JSON (misal tanpa ID, cukup nama)
        $jsonString = Storage::disk('data')->get('wilayah.json');
        $wilayah = json_decode($jsonString, true);
        $jsonString = Storage::disk('data')->get('m_data.json');
        $dataForm = json_decode($jsonString, true);
        // // Kirim data ke view
        // dd($lahan);
        return view('regis-lahan', compact('wilayah', 'title', 'dataForm', "lahan",'edit'));
    }
}
