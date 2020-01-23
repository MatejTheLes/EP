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
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endforeach

@endsection
