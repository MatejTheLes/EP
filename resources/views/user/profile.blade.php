@extends('layouts.master')

@section('content')
    <div class="row">
        <a type="button" class="btn btn-success" href="{{ route('user.change') }}"> Change</a>
        <div class="col-md-4 col-md-offset-2">
            <h1>User Profile</h1>
            <hr>

            @if($userid == 1)
                <h2>My orders</h2>
                @foreach($orders as $order)
                 <div class="card card-default">
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($order->cart->items as $item)
                            <li class="list-group-item">{{$item['naslov']}}
                                <p>x{{$item['qty']}}</p>


                            </li>

                            @endforeach
                        </ul>
                    </div>
                    <p>{{ ($order['created_at']) }}</p>
                    @if(($order['status']) == 0)
                        <p> Status: Pending</p>
                    @elseif(($order['status']) == 2)
                        <p> Status: Processed successfully</p>
                    @else
                        <p> Status: Order storno</p>
                    @endif
                    <div class="card-footer">
                        <strong> {{$order->cart->totalPrice}}€ </strong>
                    </div>

                </div>
                @endforeach

                @elseif($userid == 2)
                <h>JAz sem prodajalec!</h>
                @elseif($userid == 3)
                <h>Jaz sem administrator!</h>
                @endif
        </div>
    </div>
    @endsection
