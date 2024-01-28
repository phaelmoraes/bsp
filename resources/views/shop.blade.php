@extends('layouts.app2')

@push('css_dropzone')
<link rel="stylesheet" href="{{ asset('css/img.css') }}">

@endpush

@push('script-fisrt')
<script src="{{ asset('js/img.js') }}"></script>
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
            <div class="col-lg-12">
                <div class="card card-outline card-danger collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Cadastro de Fabricantes</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool btn-danger" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                        </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <form action="{{ route('salvarFabricante') }}" method="POST">
                      @csrf
                      <div class="form-row">
                        <div class="col">
                        <label for="fabricante">Fabricante</label>
                          <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                          <input type="text" class="form-control" id="fabricante" name="fabricante" required>
                        </div>
                      </div>

                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-danger">Cadastrar</button>
                  </div>
                  </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Cadastro de Motos</h3>
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
                            <form action="{{ route('salvarMoto') }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="form-row">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">

                                    <div class="col-sm-4">
                                        <label for="name">Fabricante</label>
                                        <select class="form-select" aria-label="manufacturer" id="manufacturer" name="manufacturer" required>
                                        @foreach($fabricantes as $fabricante)
                                            <option value="{{$fabricante->id}}">{{$fabricante->fabricante}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="lastName">Modelo</label>
                                        <input type="text" class="form-control" id="model" name="model" required/>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="loja_id">loja</label>
                                        <select class="form-select" aria-label="loja_id" id="loja_id" name="loja_id" required>
                                        @foreach($lojas as $loja)
                                            <option value="{{ $loja->id }}" @if(Auth::user()->loja->id == $loja->id) selected @endif>{{ $loja->loja }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">

                                    <div class="col-sm-6">
                                        <label for="placa">Placa</label>
                                        <input type="text" class="form-control" id="placa" name="placa" required/>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="lastName">Chassi</label>
                                        <input type="text" class="form-control" id="chassi" name="chassi"/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-4">
                                        <label for="name">Ano</label>
                                        <input type="number" size="12" class="form-control" id="ano" name="ano" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="name">Quilometragem</label>
                                        <input type="number" size="12" class="form-control" id="km" name="km" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="name">Cilindrada</label>
                                        <input type="number" size="12" class="form-control" id="cld" name="cld" required>
                                    </div>
                                    
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <h3>Informações adicionais</h3>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="name">Valor de Compra</label>
                                        <input type="text" size="12" onKeyUp="mascaraMoeda(this, event)" class="form-control" id="valor_compra" name="valor_compra" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="name">Valor Estimado de Revenda à vista</label>
                                        <input type="text" size="12" onKeyUp="mascaraMoeda(this, event)" class="form-control" id="valor_vista" name="valor_vista" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="name">Valor Estimado de Revenda à Parcelado</label>
                                        <input type="text" size="12" onKeyUp="mascaraMoeda(this, event)" class="form-control" id="valor_credito" name="valor_credito" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <label for="name">Data da Compra</label>
                                        <input type="date" size="12" class="form-control" id="data_compra" name="data_compra">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="name">Ex-proprietário</label>
                                        <input type="text" size="12" class="form-control" id="ex_proprietario" name="ex_proprietario">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="top">
                                        <p>Fotos</p>
                                    </div>
                                    <div class="drag-area">
                                        <span class="visible ">
                                            Selecione ou Arraste as fotos aqui
                                            <span class="select" role="button">Carregar Fotos</span>
                                        </span>

                                        <span class="on-drop">Drop images here</span>
                                        <input name="file[]" type="file" id="imgInput" class="file" multiple />

                                    </div>

                                    
                                </div>
                                
                                <div class="container"></div>

                                

                                
                            </div>

                            
                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-danger">Cadastrar</button>
                            </div>
                        </form>
                        </div>
                    </div>

            </div>
        </div>
        
    </div>
@endsection