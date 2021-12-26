@extends('layout')
@section('content')
<div class="container title p-1">
    <h4 class="fw-normal p-1">Transaction History</h4>
    @forelse ($transactions as $transaction)
        
    @empty

    @endforelse
</div>
@endsection
