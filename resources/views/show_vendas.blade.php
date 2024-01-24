@extends('layouts.app')

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
                        <h3 class="card-title">Dados da Venda</h3>
                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                            </div>
                        <!-- /.card-tools -->
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
                                            <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#collapse-{{$parcelas->id}}" aria-expanded="false" aria-controls="collapseExample">
                                                Detalhes
                                            </button>
                                        </p>
                                    </td>

                                </tr>


                                <tr>
                                    <td colspan="4">
                                    
                                        <div class="collapse" id="collapse-{{$parcelas->id}}">
                                            <div class="card card-body">
                                                <form action="#" name="form-{{$parcelas->id}}">
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
                                                        <button type="submit" class="btn btn-primary btn-sm-3">Atualizar</button>
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

                    <div class="card-footer">
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
@endsection

    