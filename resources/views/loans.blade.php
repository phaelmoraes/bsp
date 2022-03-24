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

<script type="text/javascript">

    var path = "{{ route('autocomplete') }}";
  
    $('#consumer').select2({
        placeholder: 'Selecione um Cliente',
        ajax: {
          url: path,
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });

  
</script>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-6">
                <div class="card card-outline card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Realizar empréstimo</h3>
                        <div class="card-tools">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <!-- Here is a label for example -->
                      <i class="fas fa-minus"></i>
                        </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <form action="{{route('borrow')}}" method="POST">
                      @csrf
                      <div class="form-row">
                        <div class="col">
                        <label for="name">Selecione o Cliente</label>
                            <select class="form-control" style="width:500px;" aria-label="Default select example" id="consumer" name="consumer" required></select>
                        </div>
                        <div class="col">
                        <label for="lastName">Colaborador</label>
                          <input type="text" class="form-control" id="collaborator" name="collaborator" value="{{ Auth::user()->name }}" readonly/>
                          <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id }}"/>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col">
                            <label for="name">Valor</label>
                            <input type="text" size="12" onKeyUp="mascaraMoeda(this, event)" class="form-control" id="price" name="price" required>
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
                            <input type="text" class="form-control" id="region" name="region" value="{{ $region->name }}" readonly>
                                
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
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                  </div>
                  </form>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title">Empréstimo</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <!-- Here is a label for example -->
                            <i class="fas fa-minus"></i>
                              </div>
                          <!-- /.card-tools -->
                        </div>

                      <div class="card-body">

                          <table class="table table_base" id="table_base" name="table_base">
                              <thead>

                                <tr>
                                  <th scope="col">Cliente</th>
                                  <th scope="col">Valor</th> 
                                  <th scope="col">Opções</th>

                                </tr>
                              </thead>
                              <tbody>
                                @foreach($loans as $loan)
                                <tr>
                                  <td>{{$loan->consumer->name}}</td>
                                  <td> R$ {{number_format($loan->price,2,",",".")}}</td>
                                  <td>
                                    <a href="{{url('loan/'.$loan->id)}}"class="btn btn-primary btn-sm">Detalhes</a>
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
</div>
@endsection
