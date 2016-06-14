@extends('app')

@section('content')

<div class="container">

    <h1>Images of {{$products->name}}</h1>
    <br>
    <a href="#" class="btn btn-info" >New Image</a>
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
            <td></td>
            <td>{{$image->extension}}</td>            
            <td>
                <a href="{{ route('products.edit', ['id' => $image->product->id])}}">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
    
    



</div>


@endsection