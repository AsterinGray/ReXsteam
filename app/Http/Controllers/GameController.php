<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        return view('game.index', compact('genres', 'games'));
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
            'image_preview' => 'required|file|mimes:jpg|max:100',
            'trailer_video' => 'required|file|mimes:webm|max:102400',
        ]);

        $image_preview = $request->file('image_preview')->getClientOriginalName();
        $trailer_video = $request->file('trailer_video')->getClientOriginalName();
        $request->file('image_preview')->storeAs('public/image_preview', $image_preview);
        $request->file('trailer_video')->storeAs('public/trailer_video', $trailer_video);
        $data["image_preview"] = 'image_preview/'.$image_preview;
        $data["trailer_video"] = 'trailer_video/'.$trailer_video;
        $data["release_date"] = now();

        Game::create($data);

        return redirect()->route('games.index')->withSuccess("Game created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::find($id);
        $owned = false;
        
        if(Auth::user()) {
            if(Auth::user()->role == 'admin') $owned = true;
            else {
                $user_id = Auth::user()->id;
                $transactions = TransactionHeader::where('user_id', $user_id)->where('checkout_status', 'completed')->get();
                foreach($transactions as $transaction) {
                    foreach($transaction->detail as $detail) {
                        if($detail->game->id == $id) {
                            $owned = true;
                            break;
                        }
                    }
                }
            }
        }

        return view('game.show', compact('game', 'owned'));
    }

    public function addToCart($id) {
        if(!Auth::check()) return redirect()->route('login');
        
        $user_id = Auth::user()->id;
        $transaction = TransactionHeader::where('user_id', $user_id)->where('checkout_status', 'cart')->first();
        $transaction_detail = $transaction->detail;
        $alreadyInCart = false;
        foreach($transaction_detail as $td) {
            if($td->game->id == $id) {
                $alreadyInCart = true;
                break;
            }
        }
        if($alreadyInCart) return redirect()->route('game.detail', [$id])->withErrors('Game already in cart');
        $detail = new TransactionDetail();
        $detail->fill([
            'transaction_id' => $transaction->id,
            'game_id' => $id,
        ]);
        $detail->save();
        return redirect()->route('game.detail', [$id])->withSuccess('Game added to cart');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
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
            'description' => 'required|max:500',
            'long_description' => 'required|max:2000',
            'genre_id' => 'required',
            'price' => 'required|numeric|max:1000000',
            'image_preview' => 'file|mimes:jpg|max:100',
            'trailer_video' => 'file|mimes:webm|max:102400',
        ]);

        if($request["image_preview"]) {
            $image_preview = $request->file('image_preview')->getClientOriginalName();
            $request->file('image_preview')->storeAs('public/image_preview', $image_preview);
            $data["image_preview"] = 'image_preview/'.$image_preview;
        } else {
            $data["image_preview"] = $game->image_preview;
        }

        if($request["trailer_video"]) {
            $trailer_video = $request->file('trailer_video')->getClientOriginalName();
            $request->file('trailer_video')->storeAs('public/trailer_video', $trailer_video);
            $data["trailer_video"] = 'trailer_video/'.$trailer_video;
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
        Game::destroy($id);

        return redirect()->back()->withSuccess("Game Deleted");
    }
}
