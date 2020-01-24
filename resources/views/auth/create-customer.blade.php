@extends('layouts.master')

@section('title')
    Amazing Book Store
@endsection




@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New customer</div>

                    <div class="card-body">
                        <form action="{{route('user.createCustomer')}}" method="post">
                            @csrf


                            <div class="alert alert-info" role="alert">
                                Here you can create a new customer account
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
                            @endif

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Customer Name</label>

                                <div class="col-md-6">
                                    <input id="sales_name" type="text" class="form-control" name="sales_name" autocomplete="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mail" class="col-md-4 col-form-label text-md-right">Customer Email</label>

                                <div class="col-md-6">
                                    <input id="sales_email" type="text" class="form-control" name="sales_email" autocomplete="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mail" class="col-md-4 col-form-label text-md-right">Customer Password</label>

                                <div class="col-md-6">
                                    <input id="sales_password" type="password" class="form-control" name="sales_password" autocomplete="">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create Customer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
