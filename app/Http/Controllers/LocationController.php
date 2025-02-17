<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function CountriesIndex() {
        $countries = Countries::get();

        return view('admin.countries.list', compact('countries'));
    }
}
