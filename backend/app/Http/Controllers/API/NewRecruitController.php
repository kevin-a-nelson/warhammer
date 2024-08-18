<?php

namespace App\Http\Controllers\API;

use App\Services\ParseNewRecruitService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewRecruitController extends Controller
{
    public function upload(Request $request)
    {
        ParseNewRecruitService::parse($request->text, $request->board_id);

        return response()->json([
            'message' => 'success'
        ]);
    }
}
