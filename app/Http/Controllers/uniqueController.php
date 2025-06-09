<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Http\Request;

class uniqueController extends Controller
{
    public function validateBlok(Request $request)
    {
        $exists = Datatani::where('no_blok', $request->no_blok)->exists();

        return response()->json(!$exists);
    }
}
