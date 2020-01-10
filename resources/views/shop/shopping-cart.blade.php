@extends('layouts.master')

@section('title')
    Amazing Book Store
@endsection


@section('content')
    @if(Session::has('cart'))
        <div class = "row">
            <div class="col-sm-6 col-md-6">
                <ul class="list-group-item">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge">{{ $product['qty'] }} x </span>
                            <strong>{{$product['naslov']}}</strong>
                            <span class="label label-success">{{$product['price']}}</span>


                                    <li><a href="{{ route('product.reduceByOne', ['id' => $product['id']]) }}" >Remove one</a> </li>
                                    <li><a href="{{ route('product.remove', ['id' => $product['id']]) }}" >Remove all</a> </li>



                    @endforeach
                </ul>
            </div>
        </div>

        <div class = "row">
            <div class="col-sm-6 col-md-6">
                <strong>Total: {{$totalPrice}}</strong>
            </div>
        </div>
        <hr>
        <div class = "row">
            <div class="col-sm-6 col-md-6">
                <a type="button" class="btn btn-success" href="{{ route('checkout') }}"> Checkout</a>
            </div>
        </div>
    @else
        <div class = "row">
            <div class="col-sm-6 col-md-6">
                <h2>No items in cart</h2>
            </div>
        </div>

    @endif
@endsection
















