@extends('layouts.master')
@section('title')
    Amazing Book Store
@endsection

@section('content')
    @foreach($books->chunk(3) as $bookChunk)
        <div class="row" >
            @foreach($bookChunk as $book)
            <div class="col-sm-6 col-md-4">
                <div class="img-thumbnail">
                    <img src="https://www.mobileread.com/forums/attachment.php?attachmentid=111264&d=1378642555" alt="..." class="img-fluid">
                    <div class="caption">
                        <h3>{{ $book['NASLOV'] }}</h3>
                        <h5>{{ $book['IMEAVTOR'] }}</h5>
                        <p class="description">{{ $book['OPISKNJIGE'] }}</p>
                        <div class="clearfix">
                            <div class="pull-left price">{{ $book['CENA'] }}€</div>

                            <a href="{{ route('product.addToCart', ['id' => $book['ID']]) }}" class="btn btn-success pull-right" role="button">Add to Cart</a>
                            @if($vloga == 2)
                                <button type="button" class="btn btn-danger small" style="height: 45px"><a style="color: white; text-decoration: none;" href="{{ route('product.deleteItem', ['id' => $book['ID']]) }}" class="btn btn-alert pull-right" role="button">Delete Item</a></button>
                                <button type="button" class="btn btn-warning" style="height: 45px"><a style="color: white; text-decoration: none;" href="{{ route('product.getEditProduct', ['id' => $book['ID']]) }}">Edit Item</a></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endforeach

@endsection
