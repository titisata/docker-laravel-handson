<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function show($id)
    {
        $partner = Partner::find($id);
        if ($partner == null) {
            return abort(404);
        }
        return view('partner.detail', compact('partner'));
    }
}
