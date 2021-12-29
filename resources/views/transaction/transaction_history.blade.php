@extends('layout.main')
@section('title', 'Transaction History')
@section('content')
@parent
<div class="container title p-1">
    <h4 class="fw-normal p-1">Transaction History</h4>
    @forelse ($transactions as $transaction)
      <div class="card">
        <div class="card-body">
          <p class="card-text mb-0">Transaction ID: {{$transaction->id}}</p>
          <p class="card-text">Purchased Date: {{$transaction->updated_at}}</p>
          @foreach ($transaction->detail as $detail)
            <img src="storage/{{$detail->game->image_preview}}" class="mb-2 me-2" style="width: 30%" alt="">
          @endforeach
          <p class="card-text">Total Price: <strong>Rp. {{$transaction->total_price}}</strong></p>
        </div>
      </div>
    @empty
    <h4 class="fw-normal fs-5 p-1">Your transaction history is empty</h4>
    @endforelse
</div>
@endsection
