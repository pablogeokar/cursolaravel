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
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                    @forelse($cart->all() as $k=>$item)
                    <tr>
                        <td class="cart_product">
                            <a href="#">
                                Imagem
                            </a>
                        </td>

                        <td class="cart_description">
                            <h4><a href="#">{{ $item['name'] }}</a></h4>
                            <p>Código: {{ $k }}</p>
                        </td>

                        <td class="cart_price">
                            R${{ $item['price'] }}                            
                        </td>

                        <td class="cart_quantity">
                            <input type="number" acao="{{ route('products.cart.update', ['id' =>$k]) }}" value="{{ $item['qtd'] }}">
                        </td>

                        <td class="cart_total">
                            <p class="cart_total_price">R${{ $item['price'] * $item['qtd'] }}</p> 
                        </td>

                        <td class="cart_delete">
                            <a href="{{ route('products.cart.destroy', ['id' => $k]) }}" class="cart_quantity_delete">Delete</a>                           
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
                                    TOTAL: R$ {{ $cart->getTotal() }}
                                </span>
                                <a href="#" class="btn btn-success">Fechar a conta</a>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>

    </div>
</section>

@endsection

@section('scripts')

<script>
    $(document).ready(function () {

        $("input").change(function () {
            var acao = $(this).attr('acao');
            var qtd = $(this).val();
            var link = acao + '/' + qtd;
            window.location.href = link;
        });



    });
</script>


@endsection

