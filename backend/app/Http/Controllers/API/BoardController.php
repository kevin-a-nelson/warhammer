<?php

namespace App\Http\Controllers\API;

use App\Models\BoardUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Board;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $boardIds = BoardUser::where('user_id', $request->user_id)->pluck('board_id');

        $boards = Board::whereIn('id', $boardIds)->with('users')->get();

        return response()->json($boards);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $board = Board::create([
            'name' => $request->name,
        ]);

        BoardUser::create([
            'board_id' => $board->id,
            'user_id' => $request->user_id,
            'is_owner' => true,
        ]);

        return [
            "name" => $board->name,
            "users" => $board->users
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
