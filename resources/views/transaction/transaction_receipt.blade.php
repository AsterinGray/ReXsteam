@extends('layout.main')
@section('title', 'Transaction Receipt')
@section('content')
@parent
<div class="container title p-1">
    <h4 class="fw-normal p-1">Transaction Receipt</h4>
    <p>Transaction ID: {{$transaction->id}}</p>
    <p>Purchased Date: {{$transaction->updated_at}}</p>
    <table class="table">
        <tbody>
            @foreach ($games as $game)
                <tr>
                    <td class="py-0 col-md-2">
                        <img src="{{asset("storage/".$game->image_preview)}}" alt="Image Preview" class="py-3" height="120px">
                    </td>
                    <td class="py-4 col-md-10">
                        <strong>{{ $game->title }}</strong>
                        <p>Rp. {{ number_format($game->price) }}</p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p class="p-1">Total Price: <strong>Rp. {{number_format($transaction->total_price)}}</strong></p>
    <a href="/"><button type="button" class="btn btn-secondary">Back to Home</button></a>
</div>
@endsection
