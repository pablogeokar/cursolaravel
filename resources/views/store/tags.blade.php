@extends('store.store')

@section('categories')
@include('store.partial.categories')
@stop


@section('content')

<div class="col-sm-9 padding-right">    


    
    <div class="features_items"><!--categories-->
        <h2 class="title text-center">Produtos com a tag {{$tag->name}}</h2>

         @foreach($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">


                       @if(count($product->images))
                            <img src="{{ url('uploads/'.$product->images->first()->id.'.'.$product->images->first()->extension) }}" alt="" width="200" />
                        @else
                            <img src="{{ url('images/no-img.jpg') }}" alt="" width="200" />
                        @endif

                        <h2>{{$product->price}}</h2>
                        <p>{{$product->name}}</p>
                        <a href="http://commerce.dev:10088/product/4" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>Mais detalhes</a>

                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar no carrinho</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{$product->price}}</h2>
                            <p>{{$product->name}}</p>
                            <a href="http://commerce.dev:10088/product/4" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>Mais detalhes</a>

                            <a href="http://commerce.dev:10088/cart/4/add" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar no carrinho</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           @endforeach
        
    </div>
    <!--categories-->

</div>
@endsection
