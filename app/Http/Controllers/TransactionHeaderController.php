<?php

namespace App\Http\Controllers;

use App\Models\TransactionHeader;
use App\Http\Requests\StoreTransactionHeaderRequest;
use App\Http\Requests\UpdateTransactionHeaderRequest;
use App\Models\Game;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class TransactionHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $transaction = TransactionHeader::where('user_id', $user_id)->where('checkout_status', 'cart')->first();
        $detail = $transaction->detail;
        $games = $detail->map(function($item) {
            return Game::where('id', $item->game_id)->first();
        });
        $total_price = $games->sum('price');
        return view('transaction.transaction_information', compact('total_price'));
    }

    public function receipt($transactionId) {
        $transaction = TransactionHeader::find($transactionId);
        $detail = $transaction->detail;
        $games = $detail->map(function($item) {
            return Game::where('id', $item->game_id)->first();
        });
        return view('transaction.transaction_receipt', compact('transaction', 'games'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $messages = [
            'expired_monty.numeric' => 'Card month must be in numeric',
            'expired_year.numeric' => 'Card year must be in numeric',
            'cvc.numeric' => 'Card CVV must be in numeric',
            'postal_code.numeric' => 'ZIP must be in numeric',
            'card_country.required' => 'Card country must be selected',
            'required' => ':attribute field cannot be blank',
            'between' => ':attribute must be between :min and :max'
        ];

        $attributes = [
            'card_name' => 'Card name',
            'card_number' => 'Card number',
            'card_country' => 'Card country',
            'expired_month' => 'Card month',
            'expired_year' => 'Card year',
            'cvc' => 'Card CVV',
            'postal_code' => 'ZIP'
        ];

        $rules = [
            'card_name' => 'required',
            'card_number' => 'required',
            'card_country' => 'required',
            'expired_month' => 'required|between:1,12|numeric',
            'expired_year' => 'required|between:2021,2050|numeric',
            'cvc' => 'required|numeric|between:100,9999',
            'postal_code' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        $validator->after(function ($validator) use ($request) {
            if($request->card_number != null &&
            ($request->card_number[4] != ' ' ||
            $request->card_number[9] != ' ' ||
            $request->card_number[14] != ' ')) {
                $validator->errors()->add('card_number', 'Card number must be in \'0000 0000 0000 0000\' format');
                return;
            }
            for($i = 0; $i < strlen($request->card_number); $i++) {
                if($i != 4 && $i != 9 && $i != 14 && !is_numeric($request->card_number[$i]))
                    $validator->errors()->add('card_number', 'Card number must be in \'0000 0000 0000 0000\' format');
            }

        });

        $validator->validate();

        $transaction = TransactionHeader::where('user_id', $user_id)->where('checkout_status', 'cart')->first();
        $detail = $transaction->detail;
        $games = $detail->map(function($item) {
            return Game::where('id', $item->game_id)->first();
        });
        $total_price = $games->sum('price');

        $transaction->fill([
            'card_name' => $request->card_name,
            'card_number' => $request->card_number,
            'card_country' => $request->card_country,
            'expired_month' => $request->expired_month,
            'expired_year' => $request->expired_year,
            'cvc' => $request->cvc,
            'postal_code' => $request->postal_code,
            'checkout_status' => 'completed',
            'total_price' => $total_price,
        ]);
        $transaction->save();

        $user = User::find($user_id);
        $user->level += $transaction->detail->count();
        $user->save();

        $transactionHeader = new TransactionHeader;
        $transactionHeader->user_id = $user_id;
        $transactionHeader->save();

        return redirect()->route('receipt', ['transactionId' => $transaction->id])->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionHeader  $transactionHeader
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionHeader $transactionHeader)
    {
        $user_id = Auth::user()->id;
        $transactions = TransactionHeader::where('user_id', $user_id)->where('checkout_status', 'completed')->get();

        return view('transaction.transaction_history', compact('transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionHeader  $transactionHeader
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionHeader $transactionHeader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionHeaderRequest  $request
     * @param  \App\Models\TransactionHeader  $transactionHeader
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionHeaderRequest $request, TransactionHeader $transactionHeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionHeader  $transactionHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionHeader $transactionHeader)
    {
        //
    }
}
