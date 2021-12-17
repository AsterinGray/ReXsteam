<?php

namespace App\Http\Controllers;

use App\Models\TransactionHeader;
use App\Http\Requests\StoreTransactionHeaderRequest;
use App\Http\Requests\UpdateTransactionHeaderRequest;

class TransactionHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTransactionHeaderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionHeaderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionHeader  $transactionHeader
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionHeader $transactionHeader)
    {
        //
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
