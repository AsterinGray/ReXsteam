<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Genre;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::simplePaginate(8);
        $genres = Genre::all();

        if(request('search')) {
            $games = Game::where('title','LIKE',"%".request('search')."%")->simplePaginate(8);
        }

        if(request('genre')) {
            $games = $games->where('genre_id',request('genre'));
        }

        return view('game.index', compact('games', 'genres'));
    }

    public function home()
    {
        $games = Game::all();
        if(request('search')) {
            $games = Game::where('title','LIKE',"%".request('search')."%")->get();
        } else {
            $games = $games->random(8);
        }

        return view('index', compact('games'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        return view('game.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:games,title',
            'description' => 'required|max:500',
            'long_description' => 'required|max:2000',
            'genre_id' => 'required',
            'developer' => 'required',
            'publisher' => 'required',
            'price' => 'required|numeric|max:1000000000',
            'image_preview' => 'required|file|mimes:jpg|max:100000',
            'trailer_video' => 'required|file|mimes:webm|max:100000000',
        ]);

        $image_preview = $request->file('image_preview')->getClientOriginalName();
        $trailer_video = $request->file('trailer_video')->getClientOriginalName();
        $request->file('image_preview')->storeAs('public/images/image_preview', $image_preview);
        $request->file('trailer_video')->storeAs('public/images/trailer_video', $trailer_video);
        $data["image_preview"] = $image_preview;
        $data["trailer_video"] = $trailer_video;
        $data["release_date"] = now();

        Game::create($data);

        return redirect()->route('games.index')->withSuccess("Game created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return view('game.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::find($id);
        $genres = Genre::all();
        return view('game.edit', compact('game', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGameRequest  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'title' => ['required', Rule::unique('games')->ignore($game->id)],
            'description' => 'required|max:500',
            'long_description' => 'required|max:2000',
            'genre_id' => 'required',
            'developer' => 'required',
            'publisher' => 'required',
            'price' => 'required|numeric|max:1000000000',
            'image_preview' => 'file|mimes:jpg|max:100000',
            'trailer_video' => 'file|mimes:webm|max:100000000',
        ]);

        if($request["image_preview"]) {
            Storage::delete($game->image_preview);
            $image_preview = $request->file('image_preview')->getClientOriginalName();
            $request->file('image_preview')->storeAs('public/image_preview', $image_preview);
            $data["image_preview"] = $image_preview;
        } else {
            $data["image_preview"] = $game->image_preview;
        }

        if($request["trailer_video"]) {
            Storage::delete($game->trailer_video);
            $trailer_video = $request->file('trailer_video')->getClientOriginalName();
            $request->file('trailer_video')->storeAs('public/trailer_video', $trailer_video);
            $data["trailer_video"] = $trailer_video;
        } else {
            $data["trailer_video"] = $game->trailer_video;
        }

        $game->update($data);
        return redirect()->route('games.index')->withSuccess("Game Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        Storage::delete('trailer_video/'.$game->trailer_video);
        Storage::delete('image_preview/'.$game->image_preview);
        Game::destroy($game->id);

        return redirect()->back()->withSuccess("Game Deleted");
=======
        Game::destroy($id);
        return redirect()->back();
>>>>>>> be5350940b34eb85490d075010efb4a0444dc124
    }
}
