<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Penalties;

class PenaltiesController extends Controller
{
    public function penalties(){
        $penalties = Penalties::All();
        return response()->json($penalties);
    }
}
