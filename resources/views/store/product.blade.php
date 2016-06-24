@extends('store.store')

@section('categories')
@include('store.partial.categories')
@stop


@section('content')

<div class="col-sm-9 padding-right">
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">

                @if(count($product->images))
                <img alt="" src="{{ url('uploads/'.$product->images->first()->id.'.'.$product->images->first()->extension) }}">
                @else
                <img alt="" src="{{ url('images/no-img.jpg')  }}" alt='' width="200">
                @endif

            </div>
            <div class="carousel slide" id="similar-product" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach($product->images as $images)
                        <a href="#"><img alt="" src="{{ url('uploads/'.$images->id.'.'.$images->extension) }}" width="80"></a>                        
                        @endforeach
                    </div>

                </div>

            </div>

        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->

                <h2>{{ $product->category->name }} :: {{$product->name }}</h2>

                <p>{{ $product->description }}</p>
                <span>
                    <span>{{ $product->price }}</span>
                    <a href="{{ route('products.cart.add', ['id' => $product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar no carrinho</a>                    
                </span>
            </div>
            <!--/product-information-->
        </div>

        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->

                <h2>Tags relacionadas</h2>

                <p>
                    @foreach($product->tags as $Tag)
                    <a href="{{ route('products.tag', ['id'=>$Tag->id]) }}" class="label label-primary">{{ $Tag->name }}</a>
                    @endforeach
                </p>

            </div>
            <!--/product-information-->
        </div>

    </div>
    <!--/product-details-->
</div>
@endsection

