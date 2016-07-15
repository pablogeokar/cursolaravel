@extends('app')

@section('content')



<div class="container">
    <h1>Orders List</h1>

    <table class="table">
        <tr>
            <th>#</th>
            <th>Created at</th>
            <th>Items</th>
            <th>User</th>
            <th>Total</th>
            <th>Status</th>
        </tr>        
        @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{ date_format($order->created_at, 'd/m/Y H:s')}}</td>
            <td>
                <ul>
                    @foreach($order->items as $item)
                    <li>{{$item->product->name}}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{$order->user->name}}</td>
            <td>{{ number_format($order->total, 2)}}</td>          
            <td><a id="status" href="#" title="Alterar Status" data-toggle="modal" data-target="#myModal" data-acao="{{ route('orders.status', ['order' => $order->id]) }}">{{$order->status->description}}</a></td>
        </tr>
        @endforeach

    </table>
    {!! $orders->render() !!}
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alteração de Status</h4>
            </div>
            <div class="modal-body">
                <select id="select_status" class="form-control" name="status_id">
                    @foreach ($status as $opcao)
                    <option value="{{$opcao->id}}">{{$opcao->description}}</option>
                    @endforeach              
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <a id="btnUpdStatus" href="#" class="btn btn-primary">Salvar Alterações</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        var link = '';
        var status = '';
        var acao = link + '/' + status;  
        
        /*Atribui a ação ao botão salvar status*/
        $('a').on('click', function () {
            link = $(this).attr('data-acao');  // pega a acao do botão            
            $('#btnUpdStatus').attr('href', acao);        
        });

        $('select').on('change', function () {            
            status = $(this).val();
            acao = link + '/' + status;
            $('#btnUpdStatus').attr('href', acao);        
        });
        
    });
</script>
@endsection