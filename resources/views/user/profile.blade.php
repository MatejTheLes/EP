@extends('layouts.master')

@section('content')
    <div class="row">
        <a type="button" class="btn btn-success" href="{{ route('user.change') }}"> Change</a>
        <div class="col-md-4 col-md-offset-2">


            @if($userid == 1)
                <h1>User Profile</h1>
                <hr>
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

                @foreach($narocila as $narocilo)
                    <div class="card card-default">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($narocilo->cart->items as $item)
                                    <li class="list-group-item">{{$item['naslov']}}
                                        <p>x{{$item['qty']}}</p>


                                    </li>

                                @endforeach
                            </ul>
                        </div>
                        <p>{{ ($narocilo['created_at']) }}</p>
                        @if(($narocilo['status']) == 0)
                            <p> Status: Pending</p>
                        @elseif(($narocilo['status']) == 2)
                            <p> Status: Processed successfully</p>
                        @else
                            <p> Status: Order storno</p>
                        @endif
                        <div class="card-footer">
                            <strong> {{$narocilo->cart->totalPrice}}€ </strong>
                            <br>
                            <a href="{{ route('order.confirm', ['id' => $narocilo['id']]) }}">Confirm Purchase</a>
                            <a href="{{ route('order.decline', ['id' => $narocilo['id']]) }}" >Decline Purchase</a>
                        </div>

                    </div>
                @endforeach

                @elseif($userid == 3)



                <h1>Admin Dashboard</h1>
                <hr>
                <h2>Prodajalci</h2>
                @foreach($prodajalci as $prodajalec)
                    <div class="card card-default">
                        <div class="card-body">
                            <ul class="list-group">
                                <li>{{$prodajalec['name']}}</li>
                                <li>{{$prodajalec['email']}}</li>
                                <li>{{$prodajalec['vloga']}}</li>
                                <a href="{{ route('user.changeSales', ['id' => $prodajalec['id']]) }}">Update credentials</a>
                                <li><a href="{{ route('user.delete', ['id' => $prodajalec['id']]) }}" >Remove account</a> </li>
                            </ul>
                        </div>

                    </div>
                @endforeach


                @endif
        </div>
    </div>
    @endsection
