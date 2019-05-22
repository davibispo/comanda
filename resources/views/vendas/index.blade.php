@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background-color:#35718dff; color: white;"><b>PEDIDOS</b></div>

                <div class="card-body">
                    <table class="table" style="margin-bottom:0px; padding-bottom:0px">
                        <tr>
                            <td class="text-left">Itens escolhidos: <b>{{$numProdutosNaCesta}}</b></td>
                            <td class="text-right" style="font-family:verdana"><h5>Total: R$ <b>{{number_format($valorTotal ,2,',','.')}}</b></h5></td>
                        </tr>
                    </table>
                                       
                    <table class="table table-hover table-success table-sm">
                        @forelse ($vendas as $venda)
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    {{DB::table('produtos')->select('nome')->where('id',$venda->produto_id)->value('nome')}} 
                                </td>
                                <th>R$ {{number_format(DB::table('produtos')->select('valor')->where('id',$venda->produto_id)->value('valor'), 2, ',', '.')}}</th>
                                <th>
                                    {!! Form::model($venda, ['method'=>'PATCH','action'=>['VendaController@update', $venda->id]]) !!}
                                        {!! Form::hidden('ativo', '0')!!}
                                        {!! Form::submit('', ['class'=>'btn btn-danger btn-sm', 'style'=>'font-size:5px', 'data-toggle'=>'tooltip', 'title'=>'Remover item'])!!}
                                    {!! Form::close() !!}
                                </th>
                            </tr>
                        </tbody>    
                        @empty
                        <div class="alert alert-warning">
                            <p>Você ainda não escolheu...</p>
                        </div>
                        @endforelse
   
                        <tr style="background-color:white">
                            <th colspan="5" class="text-right">
                                <br>
                                <a href="{{route('vendas.concluir-venda')}}" class="btn btn-success btn-sm"><b>FAZER</b> PEDIDO</a>
                            </th>   
                        </tr>
                    </table>
                    
                    <div style="text-align: center">
                        <h5><b>CARDÁPIO</b> DISPONÍVEL</h5>
                    </div>
                       
                    <input name="produto_id" class="form-control" id="myInput" type="text" placeholder="Buscar..." style="margin-bottom:5px">                          
                    
                    <table class="table table-hover table-sm">
                        <tr style="background-color:#35718dff; color: white;">
                            <th>Produtos</th>
                            <th style="width:10%">R$</th>
                            <th><i class="fas fa-cart-arrow-down"></i></th>
                        </tr>
                        @forelse ($produtos as $produto)
                            @if ($produto->tipo == 1)
                            <tbody id="myTable" style="font-size:12px">
                            <tr>
                                <td><b>{{$produto->nome}}</b> - <i>{{$produto->descricao}}</i></td>
                                <th>{{number_format($produto->valor, 2, ',', '.')}}</th>
                                
                                <td style="width:1%">
                                    {!! Form::open(['method'=>'POST','action'=>['VendaController@store', $produto->id]]) !!}
                                        {!! Form::hidden('produto_id', $produto->id) !!}
                                        {!! Form::hidden('preco', $produto->valor) !!}
                                        {!! Form::submit('', ['class'=>'btn btn-success btn-sm', 'style'=>'font-size:5px', 'data-toggle'=>'tooltip', 'title'=>'Escolher'])!!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            </tbody> 
                            @endif   
                        @empty
                            <div class="alert-warning">
                                <p>Não há itens cadastrados no cardápio!</p>
                            </div>
                        @endforelse
                    </table>

                    <!-- Bebidas -->
                    <table class="table table-hover table-sm">
                        <tr style="background-color:#35718dff; color: white;">
                            <th>Bebidas</th>
                            <th style="width:10%">R$</th>
                            <th><i class="fas fa-cart-arrow-down"></i></th>
                        </tr>
                        @forelse ($produtos as $produto)
                            @if ($produto->tipo == 2)
                            <tbody id="myTable" style="font-size:12px">
                            <tr>
                                <td><b>{{$produto->nome}}</b> - <i>{{$produto->descricao}}</i></td>
                                <th>{{number_format($produto->valor, 2, ',', '.')}}</th>
                                
                                <td style="width:1%">
                                    {!! Form::open(['method'=>'POST','action'=>['VendaController@store', $produto->id]]) !!}
                                        {!! Form::hidden('produto_id', $produto->id) !!}
                                        {!! Form::hidden('preco', $produto->valor) !!}
                                        {!! Form::submit('', ['class'=>'btn btn-success btn-sm', 'style'=>'font-size:5px', 'data-toggle'=>'tooltip', 'title'=>'Escolher'])!!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            </tbody> 
                            @endif   
                        @empty
                            <div class="alert-warning">
                                <p>Não há itens cadastrados no cardápio!</p>
                            </div>
                        @endforelse
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

