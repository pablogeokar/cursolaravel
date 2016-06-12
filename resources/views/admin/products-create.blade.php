@extends('app')

@section('content')

<div class="container">
    <h1>Create Product</h1>

    @if ($errors->any())

    <ul class="alert">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul> 

    @endif

    {!! Form::open(['route' => 'products']) !!}     

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('price', 'price:') !!}
        {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'input_money' ]) !!}
    </div>
   

    <div class="form-group">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
    
     <div class="form-inline">

        <div class="col-md-3">
            {!! Form::label('featured', 'Featured:') !!}
            {!! Form::checkbox('featured', 1) !!}        
        </div>
        
        <div class="col-md-3">
            {!! Form::label('recommend', 'Recommend:') !!}
            {!! Form::checkbox('recommend', 1) !!}        
        </div>
        
    </div>


    <div class="form-group">
        {!! Form::submit('Add Product', ['class' => 'btn btn-primary']) !!}        
    </div>

    {!! Form::close() !!}
</div>

@endsection

@section('scripts')
@include('inc.script-money')
@endsection
