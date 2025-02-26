<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';

    protected $fillable = ['countries_id', 'state_id', 'city_name'];

    static public function getJoinData() {
        return self::select('city.*', 'countries.country_name', 'state.state_name')
            ->join('countries', 'countries.id', '=', 'city.countries_id')
            ->join('state', 'state.id', '=', 'city.state_id')
            ->orderBy('city.id', 'asc')
            ->paginate(1);
    }
}
