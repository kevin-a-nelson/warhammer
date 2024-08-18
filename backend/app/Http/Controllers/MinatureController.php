<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Minature;

class MinatureController extends Controller
{

    public function index(Request $request)
    {
        return Minature::where('board_id', $request->board_id)->get();
    }
}
