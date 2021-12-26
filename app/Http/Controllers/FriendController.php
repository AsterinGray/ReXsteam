<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Http\Requests\StoreFriendRequest;
use App\Http\Requests\UpdateFriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = 5;
        $incoming_friend = Friend::where('status', 'incoming')->where('user_id', $user_id)->get();
        $pending_friend = Friend::where('status', 'pending')->where('user_id', $user_id)->get();
        $friend = Friend::where('status', 'friend')->where('user_id', $user_id)->get();
        return view('user.friend', compact('incoming_friend', 'pending_friend', 'friend'));
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
     * @param  \App\Http\Requests\StoreFriendRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFriendRequest $request)
    {
        $user_id = 5;
        $user = User::where('username', $request['username'])->first();
        $errors = new MessageBag();
        if($user !== null) {
            if(Friend::where('user_id', $user_id)->where('friend_id', $user->id)->exists())
                $errors->add('username', 'User with username ' . $request['username'] . ' is already on your friend request/list');
            else {
                $friend_request = new Friend;
                $friend_request->fill([
                    'user_id' => $user_id,
                    'friend_id' => $user->id,
                    'status' => 'pending'
                ]);
                $friend_request->save();
            }
        } else $errors->add('username', 'User with username' . $request['username'] . ' doesnt exist');
        return redirect()->back()->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $friend = Friend::find($id);
        $friend->status = 'friend';
        $friend->save();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFriendRequest  $request
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFriendRequest $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $friend = Friend::find($id);
        $friend->delete();
        return redirect()->back();
    }
}
