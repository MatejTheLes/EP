@extends('layouts.master')

@section('title')
    Amazing Book Store
@endsection




@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit existing item</div>

                    <div class="card-body">
                        <form action="{{route('product.editProduct', ['id' => $id])}}" method="post">
                            @csrf


                            <div class="alert alert-info" role="alert">
                                Here you can edit all information regarding an item.
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
                            @endif

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Author</label>

                                <div class="col-md-6">
                                    <input id="Author" type="text" class="form-control" name="Author" autocomplete="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mail" class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" rows="5" id="desc" name="Description"></textarea>
                                    <!-- <input id="desc" type="text" class="form-control" name="desc" autocomplete=""> -->
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="mail" class="col-md-4 col-form-label text-md-right">Price</label>

                                <div class="col-md-6">
                                    <input id="Price" type="text" class="form-control" name="Price" autocomplete="" placeholder="0.00 €">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mail" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="Title" type="text" class="form-control" name="Title" autocomplete="">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Item
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
