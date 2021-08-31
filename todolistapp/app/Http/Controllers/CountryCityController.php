<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryCityController extends Controller
{
    public function index()
    {
        $country = Country::with('cities')->get();
        return response()->json($country);
    }
}
