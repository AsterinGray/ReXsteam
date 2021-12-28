<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        if(request('search')) {
            $games = Game::where('title','LIKE',"%".request('search')."%")->get();
        } else {
            $games = $games->random(8);
        }
        return view('index', compact('games'));
    }

    public function showManageGamePage(Request $request) {
        $genres = Genre::all();
        $games = Game::all();
        $genre_checked = collect([]);
        foreach((array)$request->input('genres') as $genre)
            $genre_checked->push($genre);
        if(request('search') && $genre_checked->count() > 0)
            $games = Game::whereIn('genre_id', $genre_checked)->where('title','LIKE',"%".request('search')."%")->paginate(8);
        else if(request('search') && $genre_checked->count() == 0)
            $games = Game::where('title','LIKE',"%".request('search')."%")->paginate(8);
        else if(!request('search') && $genre_checked->count() > 0)
            $games = Game::whereIn('genre_id', $genre_checked)->paginate(8);
        else $games = Game::paginate(8);
        return view('game.manage_game', compact('genres', 'games'));
    }

    public function showUpdateGamePage($gameId) {
        $game = Game::find($gameId);
        $genres = Genre::all();
        return view('game.update_game', compact('game', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::find($id);
        return view('game.index', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGameRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, $id)
    {
        $game = Game::find($id);
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:10',
            'long_description' => 'required|string|max:2000',
            'genre' => 'required',
            'price' => 'required|numeric|lte:1000000',
            'image_preview' => 'mimes:jpg|max:100',
            'trailer_video' => 'mimes:webm|max:102400'
        ]);
        if($validator->fails()) return redirect()->route('update_game');
        else return redirect()->route('manage_game')->withSuccess('Game updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Game::destroy($id);
        return redirect()->back();
    }
}
