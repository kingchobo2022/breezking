<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\Countries;
use App\Models\State;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

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

        State::where('countries_id', $id)->delete();
        City::where('countries_id', $id)->delete();


        return redirect('admin/countries')->with('success', 'Country has been deleted successfully');
    }

    public function StateList() {
        $states = State::select('state.*', 'countries.country_name')
        ->join('countries', 'countries.id', '=', 'state.countries_id')
        ->get();

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

    public function StateEdit($id) {
        $countries = Countries::get();
        $state = State::findOrFail($id);

        return view('admin.state.edit', compact('countries', 'state'));
    }

    public function StateUpdate($id, Request $request) {
     

        $state = State::findOrFail($id);
        $state->countries_id = $request->countries_id;
        $state->state_name = $request->state_name;
        $state->save();

        return redirect('admin/state')->with('success', 'State has been updated successfully');
    }

    public function StateDelete($id) {
        $state = State::findOrFail($id);
        $state->delete();

        City::where('state_id', $id)->delete();


        return redirect('admin/state')->with('success', 'State has been deleted successfully');
    }

    public function CityList() {
        $cities = City::getJoinData();
        return view('admin.city.list', compact('cities'));
    }

    public function CityAdd() {
        $countries = Countries::get();
        return view('admin.city.add', compact('countries'));
    }

    public function GetStatesName($countryId) {
        $states = State::where('countries_id', '=', $countryId)->get();

        return response()->json($states);
    }

    public function CityStore(Request $request) {
        $city = new City;
        $city->countries_id = $request->countries_id;
        $city->state_id = $request->state_id;
        $city->city_name = trim($request->city_name);
        $city->save();

        return redirect('admin/city')->with('success', 'City has been added successfully');
    }

    public function CityEdit($id) {
        $countries = Countries::get();
        $city = City::findOrFail($id);
        $states = State::where('countries_id', '=', $city->countries_id)->get();

        return view('admin.city.edit', compact('countries', 'city', 'states'));
    }

    public function CityUpdate($id, Request $request) {
        $city = City::findOrFail($id);
        $city->countries_id = $request->countries_id;
        $city->state_id = $request->state_id;
        $city->city_name = trim($request->city_name);
        $city->save();

        return redirect('admin/city')->with('success', 'City has been updated successfully');
    }  
    
    public function CityDelete($id) {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect('admin/city')->with('success', 'City has been deleted successfully');
    }

    public function AddressList() {
        $addresses = Address::getJoinData();
        return view('admin.address.list', compact('addresses'));
    }

    public function AddressAdd() {
        $countries = Countries::get();

         return view('admin.address.add', compact('countries'));
    }

    public function GetCitiesName($stateId) {
        $cities = City::where('state_id', '=', $stateId)->get();

        return response()->json($cities);
    }

    public function AddressStore(Request $request) {

        $request->validate([
            'address' => 'required|string|max:255',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'countries_id' => 'required|integer'
        ]);

        $address = new Address;
        $address->countries_id = $request->countries_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->address = trim($request->address);
        $address->save();

        return redirect('admin/address')->with('success', 'Address has been added successfully');

    }

    public function AddressEdit($id) {
        $countries = Countries::get();
        $address = Address::findOrFail($id);
        $states = State::where('countries_id', '=', $address->countries_id)->get();
        $cities = City::where('state_id', '=', $address->state_id)->get();

        
        return view('admin.address.edit', compact('countries', 'address', 'states', 'cities'));
    }

    public function AddressUpdate($id, Request $request) {
        $address = Address::findOrFail($id);
        $address->countries_id = $request->countries_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->address = trim($request->address);
        $address->save();

        return redirect('admin/address')->with('success', 'Address has been updated successfully');
    }

}
