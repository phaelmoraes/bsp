@extends('layouts.app')

@push('gallery')
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <script type='text/javascript' src="{{ asset('unitegallery/js/unitegallery.min.js') }}"></script> 
    <link rel='stylesheet' href="{{ asset('unitegallery/css/unite-gallery.css') }}" type='text/css' /> 
    <script type='text/javascript' src="{{ asset('unitegallery/themes/default/ug-theme-default.js') }}"></script> 
    <link rel='stylesheet' href="{{ asset('unitegallery/themes/default/ug-theme-default.css') }}" type='text/css' />
@endpush

@push('script-fisrt')
    <script type="text/javascript"> 
        jQuery(document).ready(function(){ 
            jQuery("#gallery").unitegallery(); 
        }); 
    </script>

    <script>
        // Adicione o script jQuery
        $(document).ready(function () {
            $('#pagamento').change(function () {
                // Oculta todos os campos adicionais
                $('#campoVista, #campoParcelado').hide();
                
                // Mostra o campo correspondente com base na seleção
                if ($(this).val() === 'vista') {
                    $('#campoVista').show();
                } else if ($(this).val() === 'parcelado') {
                    $('#campoParcelado').show();
                }
            });
        });
    </script>

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
@endpush

@section('content')
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
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <!-- Here is a label for example -->
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-lg-12">
                            <div id="gallery">
                                @foreach($fotos as $foto)
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
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
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
                                <input type="text" class="form-control" id="fabricante" name="fabricante" value="{{$moto->fabricante->fabricante}}" readonly/>

                                </div>
                                <div class="col-lg-6">
                                <label for="lastName">modelo</label>
                                <input type="text" class="form-control" id="model" name="model" value="{{$moto->modelo}}" readonly/>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-4">
                                    <label for="name">Ano</label>
                                    <input type="text" size="12" class="form-control" id="ano" name="ano" value="{{$moto->ano}}" readonly>
                                </div>

                                <div class="col-sm-4">
                                    <label for="name">Quilometragem</label>
                                    <input type="text" size="12" class="form-control" id="km" name="km" value="{{$moto->km}}" readonly>
                                </div>

                                <div class="col-sm-4">
                                    <label for="name">Cilindrada</label>
                                    <input type="text" size="12" class="form-control" id="cld" name="cld" value="{{$moto->cilindrada}}" readonly>
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12">
                                    <h3>Informações adicionais</h3>
                                </div>

                                <div class="col-sm-4">
                                    <label for="name">Valor de Compra</label>
                                    <input type="text" size="12" class="form-control" id="valor_compra" name="valor_compra" value="{{number_format($moto->valor_compra,2,',','.') }}" readonly>
                                </div>

                                <div class="col-sm-4">
                                    <label for="name">Valor à vista</label>
                                    <input type="text" size="12" class="form-control" id="valor_vista" name="valor_vista" value="{{number_format($moto->valor_vista,2,',','.') }}" readonly>
                                </div>

                                <div class="col-sm-4">
                                    <label for="name">Valor Parcelado</label>
                                    <input type="text" size="12" class="form-control" id="valor_credito" name="valor_credito" value="{{number_format($moto->valor_credito,2,',','.') }}" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-6">
                                    <label for="name">Data da Compra</label>
                                    <input type="date" size="12" class="form-control" id="data_compra" name="data_compra" value="{{$moto->data_compra}}" readonly>
                                </div>

                                <div class="col-sm-6">
                                    <label for="name">Ex-proprietário</label>
                                    <input type="text" size="12" class="form-control" id="ex_proprietario" name="ex_proprietario" value="{{$moto->ex_proprietario}}" readonly>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                        <div class="card-footer">

                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Realizar Venda
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">

                                        <div class="card-body">
                                            <form action="{{ route('venda') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                                                    <input type="hidden" class="form-control" id="loja" name="loja" value="{{Auth::user()->loja->id}}">
                                                    <input type="hidden" class="form-control" id="moto" name="moto" value="{{$moto->id}}">

                                                    <label for="nome">Nome do Cliente</label>
                                                    <input type="text" class="form-control" id="nome" name="nome" aria-describedby="emailHelp">
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="cpf">CPF</label>
                                                        <input type="text" class="form-control" id="cpf" name="cpf">
                                                    </div>
                                                        
                                                    <div class="col-sm-6">
                                                        <label for="pagamento">Forma de pagamento</label>
                                                        <select class="form-control" id="pagamento" name="pagamento" required>
                                                            <option value="" disabled selected>Selecione</option>
                                                            <option value="vista">A vista</option>
                                                            <option value="parcelado">Parcelado</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group">

                                                    <!-- Campos adicionais para pagamento à vista -->
                                                    <div class="form-group" id="campoVista" style="display: none;">
                                                        <label for="valorTotal">Valor Total</label>
                                                        <input type="text" class="form-control" id="valorTotal" name="valorTotal" onKeyUp="mascaraMoeda(this, event)">
                                                    </div>

                                                    <!-- Campos adicionais para pagamento parcelado -->
                                                    <div class="form-group" id="campoParcelado" style="display: none;">
                                                        <label for="valorTotalParcelado">Valor Total</label>
                                                        <input type="text" class="form-control" id="valorTotalParcelado" name="valorTotalParcelado" onKeyUp="mascaraMoeda(this, event)">
                                                        <label for="entrada">Entrada</label>
                                                        <input type="text" class="form-control" id="entrada" name="entrada" onKeyUp="mascaraMoeda(this, event)">
                                                        <label for="parcelas">Número de Parcelas</label>
                                                        <input type="number" class="form-control" id="parcelas" name="parcelas">
                                                    </div>

                                                </div>

                                                <button type="submit" class="btn btn-primary">Realizar Venda</button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
