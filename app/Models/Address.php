<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = ['countries_id', 'state_id', 'city_id', 'address'];

    static public function getJoinData() {
        $return = self::select('address.*', 'countries.country_name', 'state.state_name', 'city.city_name')
            ->join('countries', 'countries.id', '=', 'address.countries_id')
            ->join('state', 'state.id', '=', 'address.state_id')
            ->join('city', 'city.id', '=', 'address.city_id')
            ->orderBy('address.id', 'asc');

        return $return->paginate(1);
    }
}
