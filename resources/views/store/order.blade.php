@extends('store.store')




@section('content')

<section id="cart_items">
    <div class="container">

        <div class="table-responsive cart_info">

            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="price">Qtd</td>
                        <td class="price">Total</td>                    
                    </tr>
                </thead>

                <tbody>
                    @forelse($order->products as $item)
                    <tr>
                        <td class="cart_product">
                            <a href="#">
                                Imagem
                            </a>
                        </td>

                        <td class="cart_description">
                            <h4><a href="#">{{ $item->name }}</a></h4>
                            <p>Código: {{ $item->id }}</p>
                        </td>

                        <td class="cart_price">
                            R${{ $item['price'] }}                            
                        </td>

                        <td class="cart_quantity">
                            {{ $item['qtd'] }}
                        </td>

                        <td class="cart_total">
                            <p class="cart_total_price">R${{ $item['price'] * $item['qtd'] }}</p> 
                        </td>
                       
                    </tr>
                    @empty

                    <tr>
                        <td class="" colspan="6">
                            <p>Nenhum Item encontrado</p>
                        </td>
                    </tr>

                    @endforelse

                    <tr class="cart_menu">
                        <td colspan="6">
                            <div class="pull-right">
                                <span style="margin-right: 80px;">
                                    TOTAL: R$ {{ $order->total }}
                                </span>
                                <a href="#" class="btn btn-success">Finalizar a Compra</a>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>

    </div>
</section>

@endsection





