@extends('app')

@section('content')

<div class="container">
    <h1>Editing Product: {{ $product->name }}</h1>

    @if ($errors->any())

    <ul class="alert">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul> 

    @endif

    {!! Form::open(['route' => ['products.update', $product->id], 'method' => 'put']) !!}     
    
    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', $categories, $product->category->id, ['class' => 'form-control']) !!}
    </div> 

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('price', 'price:') !!}
        {!! Form::text('price', $product->price, ['class' => 'form-control', 'id' => 'input_money']) !!}
    </div>


    <div class="form-group">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description', $product->description, ['class' => 'form-control']) !!}
    </div>

    <div class="form-inline">

        <div class="col-md-3">
            {!! Form::label('featured', 'Featured:') !!}
            {!! Form::checkbox('featured', 1, $product->featured) !!}        
        </div>

        <div class="col-md-3">
            {!! Form::label('recommend', 'Recommend:') !!}
            {!! Form::checkbox('recommend', 1, $product->recommend) !!}        
        </div>

    </div>


    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}        
    </div>

    {!! Form::close() !!}
</div>

@endsection

@section('scripts')
@include('inc.script-money')
@endsection

