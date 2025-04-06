<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function Create()
    {
        $input = [
            'name' => 'Mobile',
            'details' => [
                'brand' => 'LG',
                'color' => ['Red', 'Black', 'Gray']
            ]
        ];    

        return Item::create($input);
    }

    public function Search()
    {
        $item = Item::whereJsonContains('details->color', 'Black')->get();

        return $item;
    }
}
