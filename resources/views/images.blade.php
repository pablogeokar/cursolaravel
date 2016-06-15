@extends('app')

@section('content')

<div class="container">

    <h1>Images of {{$products->name}}</h1>
    <br>
    <a href="{{route('products.images.create', ['id' => $products->id])}}" class="btn btn-info" >New Image</a>
    <br>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Extension</th>            
            <th>Actions</th>
        </tr>
        @foreach($products->images as $image)
        <tr>
            <td>{{$image->id}}</td>
            <td><img src="{{url('uploads/'.$image->id.'.'.$image->extension)}}" width="32"></td>
            <td>{{$image->extension}}</td>            
            <td>
                <a href="{{ route('products.images.destroy', ['id' => $image->id])}}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    
    <a href="{{route('products')}}" class="btn btn-default">Voltar</a>
    
    



</div>


@endsection