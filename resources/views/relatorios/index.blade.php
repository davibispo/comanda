@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="background-color:#35718dff; color: white;"><b>MEU HISTÓRICO</b></div>

                <div class="card-body">
                    <div style="text-align: right">
                        <a href="{{ route('vendas.index') }}" class="btn btn-success btn-sm">IR PARA <b>CARDÁPIO</b></a>
                    </div>
                    <br>
                    <table class="table table-hover table-sm">
                        <tr>
                            <th>Pedidos</th>
                            <th>R$</th>
                            <th>Data - hora</th>
                        </tr>
                        @forelse ($vendas as $venda)
                        <tbody style="font-size:12px">
                            @if ($venda->user_id == auth()->user()->id)
                                <tr>
                                    <td>
                                        {{DB::table('produtos')->select('nome')->where('id', $venda->produto_id)->value('nome')}}
                                    </td>
                                    <td>{{number_format(DB::table('vendas')->select('preco')->where('produto_id', $venda->produto_id)->value('preco'), 2, ',', '.')}}</td>
                                    <td>{{date('d/m/y', strtotime($venda->data_venda))}} - {{date('H:i', strtotime($venda->created_at))}}</td>
                                </tr>
                            @endif
                        </tbody>    
                        @empty
                        <div class="alert alert-warning">
                            <p>Não há histórico ainda!</p>
                        </div>
                        @endforelse
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

