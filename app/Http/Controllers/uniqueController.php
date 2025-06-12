<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Http\Request;

class uniqueController extends Controller
{
    public function validateBlok(Request $request)
    {
        $query = Datatani::where('no_blok', $request->no_blok);

        if ($request->filled('edit')) {
            $query->where('id', '!=', $request->edit);
        }

        return response()->json(!$query->exists());
    }
}
