<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisLapangController extends Controller
{
    public function lahan(): View
    {
        $title = "Registrasi Nomor Lapang";
        $regis_lpg = true;
        $lahans = Datatani::whereNull('lapang')->latest()->get(['id', 'no_blok', 'nama', 'varietas', 'alamat', 'luas', 'semai', 'tanam']);
        // // Kirim data ke view
        return view('lahan', compact('title', 'lahans', 'regis_lpg'));
    }
    public function lapang(): View
    {
        $lpg = true;
        $title = "Daftar Nomor Lapang";
        $lahans = Datatani::whereNotNull('lapang')->latest()->get(['id','lapang', 'no_blok', 'nama', 'varietas', 'alamat', 'luas', 'semai', 'tanam']);
        // // Kirim data ke view
        // dd($lahans);
        return view('lahan', compact('title', 'lahans','lpg'));
    }
    public function regis(Request $request, $s): RedirectResponse
    {
        $lahan = Datatani::findOrFail($s);
        $request->validate([
            'lapang' => 'required|unique:datatanis,lapang,' . $s,
        ], [
            "lapang.required" => "Nomor lapang wajib diisi",
            "lapang.unique" => "Nomor lapang sudah digunakan",
        ]);
        // dd($request->nama);
        $lahan->update([
            'lapang' => $request->lapang,
        ]);

        //redirect to index
        return redirect()->route('lapang')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
