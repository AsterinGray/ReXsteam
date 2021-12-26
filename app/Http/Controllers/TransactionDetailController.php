<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Http\Requests\StoreTransactionDetailRequest;
use App\Http\Requests\UpdateTransactionDetailRequest;
use App\Models\Game;
use App\Models\TransactionHeader;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = 5;
        $transaction = TransactionHeader::where('user_id', $user_id)->where('checkout_status', 'cart')->first();
        $detail = $transaction->detail;
        $games = $detail->map(function($item) {
            return Game::where('id', $item->game_id)->first();
        });
        return view('shopping_cart_page', compact('games'));
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
     * @param  \App\Http\Requests\StoreTransactionDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionDetailRequest  $request
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionDetailRequest $request, TransactionDetail $transactionDetail)
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
        $user_id = 5;
        $transaction = TransactionHeader::where('user_id', $user_id)->where('checkout_status', 'cart')->first();
        TransactionDetail::where('game_id', $id)->where('transaction_id', $transaction->id)->delete();
        return redirect()->back();
    }
}
