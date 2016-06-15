@extends('app')

@section('content')

<div class="container">

    <h1>Products Catalog</h1>
    <br>
    <a href="{{ route('products.create') }}" class="btn btn-info" >New product</a>
    <br>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>           
            <td>{{$product->price}}</td>      
            <td>{{$product->category->name}}</td>
            <td>
                <a href="{{ route('products.edit', ['id' => $product->id])}}">Edit</a>  |  
                <a href="{{ route('products.images', ['id' => $product->id])}}">Images</a>  |  
                <a href="{{ route('products.destroy', ['id' => $product->id])}}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $products->render() !!}



</div>


@endsection