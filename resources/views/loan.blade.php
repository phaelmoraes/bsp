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
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            Informações
                                @if($loan->status == 'opened')
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalRenegotiate">
                                    Renegociar
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalCancel">
                                    Cancelar
                                    </button>

                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalSucess">
                                    Finalizar
                                    </button>
                                @endif
                                
                        </h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <!-- Here is a label for example -->
                            <i class="fas fa-minus"></i>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">

                        <div class="card text-white bg-secondary col-lg-6">
                            <div class="card-header">Dados</div>
                            <div class="card-body">
                                <h5 class="card-title">Cliente: {{ $loan->Consumer->name }}</h5>
                                <p class="card-text">
                                    Data Empréstimo : {{date("d/m/Y", strtotime($loan->created_at))}}</br>
                                    Valor: R$ {{ number_format($loan->price,2,",",".") }}</br>
                                    Valor Total: R$ {{ number_format($loan->total_price,2,",",".") }}</br>
                                    Valor Pago: R$ {{ number_format($loan->amount_paid($loan->id),2,",",".") }}</br>
                                    Valor Restante: R$ {{ number_format($newPrice,2,',','.') }}</br>
                                    Juros: {{ $loan->fees }} %</br>
                                    Parcelas: {{ $loan->installments }}</br>
                                    Saldo: R$ {{ number_format($loan->balance,2,",",".") }}</br>
                                </p>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Ver mais...
                                </button>
                            </div>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Informações do Cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="card text-black bg-light col-sm-12">
                                        <div class="card-header"><h5>{{ $loan->Consumer->name }}</h5></div>
                                        <div class="card-body">
                                            <!-- <hr/> -->
                                            <p class="card-text">
                                                @if($loan->Consumer->type == 'PF')
                                                CPF: {{$loan->Consumer->cpf}}
                                                @else
                                                CNPJ: {{$loan->Consumer->name}}
                                                @endif
                                                <br>
                                                Email: {{$loan->Consumer->email}}<br>
                                                @if(isset($loan->Consumer->birthday))
                                                Data de Nascimento: {{ date('d/m/Y', strtotime($loan->Consumer->birthday)) }}<br>
                                                @endif
                                                Gênero: 
                                                @if($loan->Consumer->gender == 'MALE')
                                                        Masculino
                                                @else
                                                        Feminino
                                                @endif
                                                <br><br>

                                                <b>Contatos</b>
                                                <hr/>
                                                @foreach($loan->consumer->contacts as $contact)
                                                    Tipo:
                                                    @if($contact->type == 'PHONE')
                                                    <i>Telefone: </i>{{$contact->phone}}
                                                    @elseif($contact->type == 'WHATSAPP')
                                                    <i>WhatsApp: </i>{{$contact->phone}}
                                                    @else
                                                    <i>Celular: </i>{{$contact->phone}}
                                                    @endif
                                                @endforeach
                                                <br><br>

                                                <b>Endereço</b>
                                                <hr/>
                                                Rua: {{$loan->consumer->address->street}}<br>
                                                Bairro: {{$loan->consumer->address->neighborhood}}<br>
                                                Número: {{$loan->consumer->address->building_number}}<br>
                                                Complemento: {{$loan->consumer->address->complement}}<br>
                                                Cidade: {{$loan->consumer->address->city}}<br>
                                                Estado: {{$loan->consumer->address->state}}<br>
                                                Observação: {{$loan->Consumer->note}}<br>

                                                
                                            </p>
                                        </div>
                                    </div>
                                 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Cancelar-->
                        <div class="modal fade" id="modalCancel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Você deseja cancelar esse empréstimo?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Ao cancelar, todas as informações referentes a esse empréstimo sumirão.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                                    <a href="{{url('loan/cancel/'.$loan->id)}}"class="btn btn-danger">Confirmar</a>
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Renegociar -->
                        <div class="modal fade" id="modalRenegotiate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Renegociação</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    



                                <form action="{{url('loan/renegotiate/'.$loan->id)}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col">
                                        <label for="name">Selecione o Cliente</label>
                                            <select class="form-select" aria-label="Default select example" id="consumer" name="consumer">
                                                
                                                <option value="{{ $loan->Consumer->id }}">{{ $loan->Consumer->name }}</option>

                                            </select>
                                        </div>
                                        <div class="col">
                                        <label for="lastName">Colaborador2</label>
                                        <input type="text" class="form-control" id="collaborator" name="collaborator" value="{{ Auth::user()->name }}" readonly/>
                                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id }}"/>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <label for="name">Valor</label>
                                            <input type="text" size="12" onKeyUp="mascaraMoeda(this, event)" class="form-control" id="price" name="price" value="{{number_format($newPrice,2,',','.') }}" required>
                                            <input type="hidden" size="12" onKeyUp="mascaraMoeda(this, event)" class="form-control" id="price" name="old_price" value="{{number_format($newPrice,2,',','.') }}">
                                        </div>

                                        <div class="col">
                                            <label for="name">Juros</label>
                                            <select class="form-select" aria-label="Default select example" id="fees" name="fees">
                                                <option value="10">10%</option>
                                                <option value="15">15%</option>
                                                <option value="20" selected>20%</option>
                                                <option value="25">25%</option>
                                                <option value="30">30%</option>
                                                <option value="35">35%</option>
                                                <option value="40">40%</option>
                                                <option value="45">45%</option>
                                                <option value="50">50%</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="name">Prestações</label>
                                            <select class="form-select" aria-label="Default select example" id="installments" name="installments">
                                                <option value="1">1x</option>
                                                <option value="2">2x</option>
                                                <option value="3">3x</option>
                                                <option value="4">4x</option>
                                                <option value="5">5x</option>
                                                <option value="6">6x</option>
                                                <option value="7">7x</option>
                                                <option value="8">8x</option>
                                                <option value="9">9x</option>
                                                <option value="10" selected>10x</option>
                                                <option value="11">11x</option>
                                                <option value="12">12x</option>
                                                <option value="13">13x</option>
                                                <option value="14">14x</option>
                                                <option value="15">15x</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <label for="lastName">Rota</label>
                                            <input type="text" class="form-control" id="region" name="region" value="{{$loan->region->name}}" readonly>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="region">Período</label>
                                            <select class="form-select" aria-label="Default select example" id="period" name="period">
                                                <option value="diary" selected>Diário</option>
                                                <option value="weekly">Semanal</option>
                                                <option value="monthly">Mensal</option>
                                            </select>
                                        </div>
                                        
                                    </div>

                                


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Voltar</button>
                                    <button type="submit" class="btn btn-warning">Renegociar</button>
                                </div>
                                </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal Finalizar-->
                        <div class="modal fade" id="modalSucess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Você deseja finalinar esse empréstimo?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    O valor total deste emprétimo foi de R$ {{ number_format($loan->total_price,2,",",".") }}<br> 
                                    O valor total pago foi de R$ {{ number_format($amount_paid,2,",",".") }}.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                                    <a href="{{url('loan/finish/'.$loan->id)}}"class="btn btn-success">Finalizar</a>
                                </div>
                                </div>
                            </div>
                        </div>

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

                                

                                    @foreach($loan_installments as $installments)

                                    <tr>
                                        <td>{{$installments->number_installment}}</td>
                                        <td>R$ {{number_format($installments->price,2,",",".") }}</td>
                                        <td>
                                            @if($installments->status == 'paid')
                                            <span class="badge badge-success">Pago</span>
                                            @endif

                                            @if($installments->status == 'opened')
                                            <span class="badge badge-info">Em aberto</span>
                                            @endif

                                            @if($installments->status == 'delayed')
                                            <span class="badge badge-danger">Em atraso</span>
                                            @endif

                                        <td>
                                            <p>
                                                <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#collapse-{{$installments->id}}" aria-expanded="false" aria-controls="collapseExample">
                                                    Detalhes
                                                </button>
                                            </p>
                                        </td>
  
                                    </tr>


                                    <tr>
                                        <td colspan="4">
                                        
                                            <div class="collapse" id="collapse-{{$installments->id}}">
                                                <div class="card card-body">
                                                    <form action="/loan/edit/{{$installments->id}}" name="form-{{$installments->id}}">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="valor">Valor:  </label>
                                                                <input type="text" class="form-control" size="12" onKeyUp="mascaraMoeda(this, event)" id="valor-{{$installments->id}}" name="value" @if($installments->status == 'paid' || $loan->status != 'opened') value="{{ number_format($installments->amount_paid,2,",",".") }}" readonly @endif>
                                                            </div>

                                                            @if($installments->status != 'opened' && $loan->status == 'opened')
                                                            <div class="form-group col-md-4">
                                                                <label for="date">Data:  </label>
                                                                <input type="text" class="form-control" id="date-{{$installments->id}}" name="date"  value="{{ $installments->updated_at->format('d-m-Y H:i:s') }}" readonly>
                                                            </div>
                                                            @endif

                                                            @if($installments->status != 'paid' && $loan->status == 'opened')
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

                                                        @if($installments->status != 'paid' && $loan->status == 'opened')
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
                  </form>
                </div>
            </div>

            <div class="col-sm-6">

            </div>
        </div>
    </div>
</div>
@endsection