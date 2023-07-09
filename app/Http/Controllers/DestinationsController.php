<?php

namespace App\Http\Controllers;
use App\Models\Destinations;
use Illuminate\Http\Request;

class DestinationsController extends Controller
{
    public function destinations(){
        $destinations = Destinations::All();
        return response()->json($destinations);
    }
}
