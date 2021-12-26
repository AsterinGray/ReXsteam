@extends('layout')
@section('content')
<div class="container title p-1">
    <h4 class="fw-normal p-1">Transaction Information</h4>
    <form class="row g-3 p-4" method="POST" action="{{route('transaction.store')}}" enctype="multipart/form-data">
        @csrf
        <div>
          <label for="cardName" class="form-label">Card Name</label>
          <input type="text" name="card_name" minlength="6" class="form-control" placeholder="Card Name">
        </div>
        <div class="mb-3">
          <label for="cardNumber" class="form-label">Card Number</label>
          <input type="text" name="card_number" minlength="16" maxlength="16" class="form-control" placeholder="0000 0000 0000 0000" aria-describedby="cardNumberHelp">
          <div id="cardNumberHelp" class="form-text">VISA or Master Card.</div>
        </div>
        <div class="row mb-3">
          <div class="col-8">
            <label for="expiredDate" class="form-label">Expired Date</label>
            <div class="row">
                <div class="col-6">
                    <input type="text" name="expired_month" maxlength="2" class="form-control" placeholder="MM">
                </div>
                <div class="col-6">
                    <input type="text" name="expired_year" maxlength="4" class="form-control" placeholder="YYYY">
                </div>
            </div>
          </div>
          <div class="col-4">
              <label for="cvc" class="form-label">CVC / CVV</label>
              <input type="text" name="cvc" class="form-control" maxlength="4" placeholder="3 or 4 digit number">
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col-8">
            <label for="country" class="form-label">Country</label>
            <select class="form-select" name="card_country">
                <option selected>Indonesia</option>
                <option value="Spain">Spain</option>
                <option value="Italy">Italy</option>
                <option value="England">England</option>
            </select>
          </div>
          <div class="col-4">
            <label for="zip" class="form-label">ZIP</label>
            <input type="text" name="postal_code" class="form-control" placeholder="ZIP">
          </div>
        </div>
        <div class="row mt-3">
            <div class="col-9">
                <p class="ps-3">Total Price: <strong>Rp. {{$total_price}}</strong></p>
            </div>
            <div class="col-3">
                <a class="btn p-0 me-2" href="/cart"><button class="btn btn-light" type="button">Cancel</button></a>
                <button type="submit" class="btn btn-secondary checkout"><i class="fa fa-shopping-cart"></i> Checkout</button>
            </div>
        </div>
    </form>
    @if ($errors->any())
    <div class="px-4">
        <strong>There were {{$errors->count()}} errors with your submission</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection
