<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\State;
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

    public function CountriesEdit($id) {
        
        $country = Countries::findOrFail($id);

        return view('admin.countries.edit', compact('country'));
    }

    public function CountriesUpdate($id, Request $request) {
        // $country = Countries::find($id);
        // $country->country_name = trim($request->country_name);
        // $country->save();
        $request->validate([
            'country_name' => 'required|string|max:255'
        ]);

        $country = Countries::find($id);
        if(!$country) {
            return redirect('admin/countries')->with('error', 'The data has been deleted or does not exist.');    
        }

        Countries::where('id', $id)->update([
            'country_name' => trim($request->country_name)
        ]);

        return redirect('admin/countries')->with('success', 'Country has been updated successfully');
    }

    public function CountriesDelete($id) {
        $country = Countries::find($id);
        if(!$country) {
            return redirect('admin/countries')->with('error', 'The data has already been deleted or does not exist.');       
        }
        $country->delete();

        return redirect('admin/countries')->with('success', 'Country has been deleted successfully');
    }

    public function StateList() {
        $states = State::get();
        return view('admin.state.list', compact('states'));
    }

    public function StateAdd() {
        $countries = Countries::get();
        return view('admin.state.add', compact('countries'));
    }

    public function StateStore(Request $request) {

        $request->validate([
            'state_name' => 'required|string|max:255'
        ]);
        
        $state = new State;
        $state->countries_id = $request->countries_id;
        $state->state_name = $request->state_name;
        $state->save();

        return redirect('admin/state')->with('success', 'State has been added successfully');
    }
}
