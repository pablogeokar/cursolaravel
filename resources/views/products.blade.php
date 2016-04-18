<h1>Products Catalog</h1>

<ul>
    @foreach($products as $product)
        <li>{{$product->name}} - ({{$product->description}}) US$ {{$product->price}}</li>
    @endforeach
</ul>