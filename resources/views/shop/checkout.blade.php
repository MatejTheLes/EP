@extends('layouts.master')

@section('title')
    Amazing Book Store
@endsection


@section('content')
    <div class="alert alert-success" role="alert">
        Your order totaling {{$total}}€ has been successfully processed!
        Thank you for shopping with us!
    </div>

@endsection
