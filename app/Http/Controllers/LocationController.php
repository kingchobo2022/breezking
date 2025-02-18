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

    public function CountriesAdd() {
        return view('admin.countries.add');
    }

    public function CountriesStore(Request $request) {
        // $country = new Countries;
        // $country->country_name = trim($request->country_name);
        // $country->save();

        $request->validate([
            'country_name' => 'required|string|max:255'
        ]);

        Countries::create([
            'country_name' => trim($request->country_name)
        ]);

        return redirect('admin/countries')->with('success', 'Country Successfully Add');
    }
}
