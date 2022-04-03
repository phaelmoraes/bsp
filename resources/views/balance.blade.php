@extends('layouts.app')

@push('script-fisrt')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#collaborator").select2();
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
<?php
    $permissao = Auth::user()->function ;
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
        @if( $permissao == "Administrator")
            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            Balanço
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
                    <table class="table table_base" id="example1" name="example1">
                              <thead>

                                <tr>
                                  <th scope="col">Colaborador</th>
                                  <th scope="col">Saldo</th>
                                  <th scope="col">Empréstimos de Hoje</th>
                                  <th scope="col">Recebido hoje</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($users as $user)
                                <tr>
                                  <td>{{ $user->name }}</td>
                                  <td>R$ {{ number_format($user->balance,2,",",".") }}</td>
                                  <td>R$ {{ number_format($user->loanToday($user->id),2,",",".") }}</td>
                                  <td>R$ {{ number_format($user->loanInstallmentsToday($user->id),2,",",".") }}</td>
                                </tr>
                                @endforeach


                                
                              </tbody>
                          </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        

            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            Adicionar saldo
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
                        <form action="{{route('AddBalance')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-lg-6">
                                <label for="collaborator">Colaborador</label>
                                <select class="form-select" aria-label="Default select example" name="collaborator" id="collaborator" required>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <div class="col">
                                <label for="lastName">Valor</label>
                                <input type="text" maxlength="25" onKeyUp="mascaraMoeda(this, event)" class="form-control" id="value" name="value" required/>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        @endif

            <div class="col-lg-6">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Balanço
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
                    <table class="table table_base" id="example1" name="example1">
                              <thead>

                                <tr>
                                  <th scope="col">Colaborador</th>
                                  <th scope="col">Saldo</th>
                                  <th scope="col">Empréstimos de Hoje</th>
                                  <th scope="col">Recebido hoje</th>
                                </tr>
                              </thead>
                              <tbody>

                                <tr>
                                  <td>{{ Auth::user()->name }}</td>
                                  <td>R$ {{ number_format(Auth::user()->balance,2,",",".") }}</td>
                                  <td>R$ {{ number_format(Auth::user()->loanToday(Auth::user()->id),2,",",".") }}</td>
                                  <td>R$ {{ number_format(Auth::user()->loanInstallmentsToday(Auth::user()->id),2,",",".") }}</td>
                                </tr>



                                
                              </tbody>
                          </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection