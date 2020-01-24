@extends('layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-12" >


            @if($userid == 1)
                <h1>User Profile</h1>
                <hr>
                <h2> My account details</h2>
                <button type="button" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="{{ route('user.change') }}"> Change</a></button>
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
                         <p style="color:green"> Status: Processed successfully</p>
                    @else
                         <p style="color: red"> Status: Order Declined</p>
                    @endif
                    <div class="card-footer">
                        <strong> {{$order->cart->totalPrice}}€ </strong>
                    </div>

                </div>
                @endforeach





                @elseif($userid == 2)
                <hr>
                <h2> My account details</h2>
                <button type="button" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="{{ route('user.change') }}"> Change</a></button>
                <button type="button" class="btn btn-warning" style="width: 200px"><a style="color: white; text-decoration: none;" href="{{ route('user.getCreateCustomer') }}">Create Customer</a></button>
                <hr>
                <h2>All orders</h2>

                <hr>
                @foreach($narocila->chunk(3) as $narociloChunk)
                <div class="row">

                    @foreach($narociloChunk as $narocilo)
                        <div class="col-sm-6 col-md-4">

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
                                    <p style="color:green"> Status: Processed successfully</p>
                                @else
                                    <p style="color: red"> Status: Order Declined</p>
                                @endif
                                <div class="card-footer">
                                    <strong> {{$narocilo->cart->totalPrice}}€ </strong>
                                    <br>
                                    <button type="button" class="btn btn-success"><a style="color: white; text-decoration: none;" href="{{ route('order.confirm', ['id' => $narocilo['id']]) }}"> Confirm Purchase</a></button>
                                    <button type="button" class="btn btn-danger"><a style="color: white; text-decoration: none;" href="{{ route('order.decline', ['id' => $narocilo['id']]) }}"> Decline Purchase</a></button>

                                </div>

                            </div>
                        </div>

                    @endforeach

                </div>
                @endforeach


                @elseif($userid == 3)



                <h1>Admin Dashboard</h1>
                <hr>
                <h2> My account details</h2>
                <button type="button" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="{{ route('user.change') }}"> Change</a></button>
                <hr>
                <button type="button" class="btn btn-warning" style="width: 200px"><a style="color: white; text-decoration: none;" href="{{ route('user.getCreateSales') }}">Create Salesman</a></button>

                <h2>Prodajalci</h2>
                @foreach($prodajalci as $prodajalec)
                    <div class="card card-default">
                        <div class="card-body">
                            <ul class="list-group">
                                <li>Ime prodajalca: {{$prodajalec['name']}}</li>
                                <li>E-mail prodajalca: {{$prodajalec['email']}}</li>
                                <li>Vloga: {{$prodajalec['vloga']}}</li>
                                <button type="button" class="btn btn-success" style="width: 200px"><a style="color: white; text-decoration: none;" href="{{ route('user.changeSales', ['id' => $prodajalec['id']]) }}">Update credentials</a></button>
                                <button type="button" class="btn btn-danger" style="width: 200px"><a style="color: white; text-decoration: none;" href="{{ route('user.delete', ['id' => $prodajalec['id']]) }}">Delete Account</a></button>

                            </ul>
                        </div>

                    </div>
                @endforeach


                @endif
        </div>
    </div>
    @endsection
