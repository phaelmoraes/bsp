@extends('layouts.app2')



@push('script-fisrt')
<script>
        
    String.prototype.reverse = function(){
        return this.split('').reverse().join(''); 
    };

    function mascaraMoeda(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "##.###.###,##".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
                resultado += mascara.charAt(x);
                x++;
            } else {
                resultado += valor.charAt(y);
                y++;
                x++;
            }
        }
        campo.value = resultado.reverse();
    };

</script>

<script type="text/javascript"> 
    jQuery(document).ready(function(){ 
        jQuery("#gallery").unitegallery(); 
    }); 
</script>

@endpush

@push('gallery')
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <script type='text/javascript' src="{{ asset('unitegallery/js/unitegallery.min.js') }}"></script> 
    <link rel='stylesheet' href="{{ asset('unitegallery/css/unite-gallery.css') }}" type='text/css' /> 
    <script type='text/javascript' src="{{ asset('unitegallery/themes/default/ug-theme-default.js') }}"></script> 
    <link rel='stylesheet' href="{{ asset('unitegallery/themes/default/ug-theme-default.css') }}" type='text/css' />
@endpush

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif


    <div class="container-fluid">
        <div class="row">
            <!-- Detalhes da Moto -->
            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Detalhes da Moto</h3>
                        <div class="card-tools">
                            <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <button type="button" class="btn btn-tool btn-danger" data-card-widget="collapse">
                            <!-- Here is a label for example -->
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-lg-12">
                            <div id="gallery">
                                @foreach($venda->moto->fotos as $foto)
                                    <img alt="Image 1 Title" src="{{ asset($foto->caminho) }}"
                                        data-image="{{ asset($foto->caminho) }}"
                                        data-description="Image 1 Description">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
            <!-- Cadastro de Motos -->
            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Informações</h3>
                            <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <button type="button" class="btn btn-tool btn-danger" data-card-widget="collapse">
                            <!-- Here is a label for example -->
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">

                                <div class="col-lg-6">
                                <label for="name">fabricante</label>
                                <input type="text" class="form-control" id="fabricante" name="fabricante" value="{{$venda->moto->fabricante->fabricante}}" readonly/>

                                </div>
                                <div class="col-lg-6">
                                <label for="lastName">modelo</label>
                                <input type="text" class="form-control" id="model" name="model" value="{{$venda->moto->modelo}}" readonly/>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-4">
                                    <label for="name">Ano</label>
                                    <input type="text" size="12" class="form-control" id="ano" name="ano" value="{{$venda->moto->ano}}" readonly>
                                </div>

                                <div class="col-sm-4">
                                    <label for="name">Quilometragem</label>
                                    <input type="text" size="12" class="form-control" id="km" name="km" value="{{$venda->moto->km}}" readonly>
                                </div>

                                <div class="col-sm-4">
                                    <label for="name">Cilindrada</label>
                                    <input type="text" size="12" class="form-control" id="cld" name="cld" value="{{$venda->moto->cilindrada}}" readonly>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="col-sm-6">
                                    <label for="name">Loja</label>
                                    <input type="text" size="12" class="form-control" id="loja" name="loja" value="{{$venda->loja->loja}}" readonly>
                                </div>

                                <div class="col-sm-6">
                                    <label for="name">Data da venda</label>
                                    <input type="text" size="12" class="form-control" id="dt_venda" name="dt_venda" value="{{$venda->created_at}}" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12">
                                    <h3>Informações adicionais</h3>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-6">
                                    <label for="name">Forma de Pagamento</label>
                                    <?php
                                    $pagamento = 0;
                                    if($venda->forma_pagamento == 'vista'){
                                        $pagamento = "Pagamento a Vista";
                                    }else {
                                        $pagamento = "Pagamento a Parcelado, com entrada de R$ ".number_format($venda->entrada,2,',','.').".";
                                    }

                                    ?>
                                    <input type="texte" size="12" class="form-control" id="form_pag" name="form_pag" value="{{$pagamento}}" readonly>
                                </div>

                                <div class="col-sm-6">
                                    <label for="name">Cliente</label>
                                    <input type="text" size="12" class="form-control" id="cliente" name="cliente" value="{{$venda->cliente}}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label for="name">Vendedor</label>
                                    <input type="text" size="12" class="form-control" id="vendedor" name="vendedor" value="{{$venda->vendedor->name}}" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                            <div class="col-sm-4">
                                    <label for="name">Valor Total</label>
                                    <input type="text" size="12" class="form-control" id="valor_total" name="valor_total" value="{{number_format($venda->valor_total,2,',','.')}}" readonly>
                                </div>

                                <div class="col-sm-4">
                                    <label for="name">Valor Pago</label>
                                    <input type="text" size="12" class="form-control" id="valor_pago" name="valor_pago" value="{{number_format($venda->valor_pago,2,',','.')}}" readonly>
                                </div>

                                <div class="col-sm-4">
                                    <label for="name">Saldo Devedor</label>
                                    <input type="text" size="12" class="form-control" id="saldo_devedor" name="saldo_devedor" value="{{number_format(($venda->valor_total - $venda->valor_pago),2,',','.')}}" readonly>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                        <div class="card-footer">

                        </div>
                    
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <!-- Detalhes da Moto -->
            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Detalhes da Moto</h3>
                        <div class="card-tools">
                            <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <button type="button" class="btn btn-tool btn-danger" data-card-widget="collapse">
                            <!-- Here is a label for example -->
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table_base" id="table_base" name="table_base">
                            <thead>

                                <tr>
                                    <th scope="col">N. da Parcela</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Status</th> 
                                    <th scope="col">Opções</th>

                                </tr>
                            </thead>

                            <tbody>

                                

                                    @foreach($venda->getParcelas as $parcelas)

                                    <tr>
                                        <td>{{$parcelas->n_parcela}}</td>
                                        <td>R$ {{number_format($parcelas->valor,2,",",".") }}</td>
                                        <td>
                                            @if($parcelas->status == 'pago')
                                            <span class="badge badge-success">Pago</span>
                                            @endif

                                            @if($parcelas->status == 'aberto')
                                            <span class="badge badge-info">Em aberto</span>
                                            @endif

                                            @if($parcelas->status == 'atraso')
                                            <span class="badge badge-danger">Em atraso</span>
                                            @endif

                                        <td>
                                            <p>
                                                <button class="btn btn-secondary btn-sm" type="button" data-toggle="collapse" data-target="#collapse-{{$parcelas->id}}" aria-expanded="false" aria-controls="collapseExample">
                                                    Detalhes
                                                </button>
                                            </p>
                                        </td>

                                    </tr>


                                    <tr>
                                        <td colspan="4">
                                        
                                            <div class="collapse" id="collapse-{{$parcelas->id}}">
                                                <div class="card card-body">
                                                    <form action="/vendas/edit/{{$parcelas->id}}" name="form-{{$parcelas->id}}">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="valor">Valor:  </label>
                                                                <input type="text" class="form-control" size="12" onKeyUp="mascaraMoeda(this, event)" id="valor-{{$parcelas->id}}" name="value" @if($parcelas->status == 'pago') value="{{ number_format($parcelas->valor_pago,2,",",".") }}" readonly @endif>
                                                            </div>

                                                            @if($parcelas->status != 'aberto')
                                                            <div class="form-group col-md-4">
                                                                <label for="date">Data:  </label>
                                                                <input type="text" class="form-control" id="date-{{$parcelas->id}}" name="date"  value="{{ $parcelas->updated_at->format('d-m-Y H:i:s') }}" readonly>
                                                            </div>
                                                            @endif

                                                            @if($parcelas->status != 'pago')
                                                            <div class="col-md-2">
                                                                <b>Opções:</b>
                                                                <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="gridCheck" name="status">
                                                                    <label class="form-check-label" for="gridCheck">
                                                                        Atraso
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>

                                                        @if($parcelas->status != 'pago')
                                                        <div class="col-sm-2 align-self-center">
                                                            <button type="submit" class="btn btn-danger btn-sm-3">Atualizar</button>
                                                        </div>
                                                            
                                                        @endif

                                                    </form>

                                                    
                                                    



                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>

                                    
                                    
                                    @endforeach

                                    
                            </tbody>
                        </table>

                    </div>  
                </div>
            </div>
        </div>


        
    </div>

    
@endsection

    