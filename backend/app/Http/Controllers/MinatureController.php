<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardMinature;
use Illuminate\Http\Request;
use App\Models\Minature;

class MinatureController extends Controller
{

    public function index(Request $request)
    {
        $minatureBoards = collect(BoardMinature::where('board_id', $request->board_id)->get())->map(function ($minatureBoard) {
            return [
                ...Minature::find($minatureBoard->minature_id)->toArray(),
                'xCord' => $minatureBoard->xCord,
                'yCord' => $minatureBoard->yCord
            ];
        });

        return $minatureBoards;
    }
}
