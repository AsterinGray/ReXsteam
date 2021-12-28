@extends('layout.main')
@section('title', 'Shopping Cart')
@section('content')
@parent
<div class="container title p-1">
    <h4 class="fw-normal p-1">Shopping Cart</h4>
    <table class="table">
        <tbody>
            @forelse ($games as $game)
                <tr class="data-row">
                    <td class="py-0 col-md-2">
                        <img src="{{ "storage/".$game->image_preview }}" alt="Image Preview" class="py-3" height="120px">
                    </td>
                    <td class="py-3 col-md-8">
                        <strong class="mb-0">{{ $game->title }}</strong>
                        <p><small class="text-muted">{{$game->genre->name}}</small></p>
                        <p>Rp. {{ $game->price }}</p>
                    </td>
                    <td class=" py-5 col-md-2">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$game->id}}">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">
                        <div class="container title p-1">
                            <h4 class="fw-normal fs-3 p-1 text-center">No data...</h4>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <p class="p-1">Total Price: <strong>Rp. {{$games->sum('price')}}</strong></p>
    <button class="btn btn-secondary m-2">
        <i class="fa fa-shopping-cart"></i>
        @if ($games->count() > 0)
            <a class="btn checkout p-0" href="/transaction">&nbsp;Checkout</a>
        @else
            <a class="btn checkout p-0" href="/cart">&nbsp;Checkout</a>
        @endif
    </button>
    @foreach ($games as $game)
    <div class="modal fade" id="delete-modal-{{$game->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Delete Cart</h5>
                </div>
                <form action="{{route('cart.destroy', $game->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        Are you sure you want to delete this game from your shopping cart? All of your data will be permanently removed. This action cannot be undone.
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
