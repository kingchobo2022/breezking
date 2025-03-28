<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function Support()
    {
        $supports = Support::getSupportList();

        return view('admin.support.list', compact('supports'));
        
    }
}
