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

<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "pageLength": 5,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "language": 
      {
        "emptyTable": "Nenhum registro encontrado",
        "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 até 0 de 0 registros",
        "infoFiltered": "(Filtrados de _MAX_ registros)",
        "infoThousands": ".",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "zeroRecords": "Nenhum registro encontrado",
        "search": "Pesquisar",
        "paginate": {
            "next": "Próximo",
            "previous": "Anterior",
            "first": "Primeiro",
            "last": "Último"
        },
        "aria": {
            "sortAscending": ": Ordenar colunas de forma ascendente",
            "sortDescending": ": Ordenar colunas de forma descendente"
        },
        "select": {
            "rows": {
                "_": "Selecionado %d linhas",
                "1": "Selecionado 1 linha"
            },
            "cells": {
                "1": "1 célula selecionada",
                "_": "%d células selecionadas"
            },
            "columns": {
                "1": "1 coluna selecionada",
                "_": "%d colunas selecionadas"
            }
        },
        "buttons": {
            "copySuccess": {
                "1": "Uma linha copiada com sucesso",
                "_": "%d linhas copiadas com sucesso"
            },
            "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
            "colvis": "Visibilidade da Coluna",
            "colvisRestore": "Restaurar Visibilidade",
            "copy": "Copiar",
            "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
            "copyTitle": "Copiar para a Área de Transferência",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
                "-1": "Mostrar todos os registros",
                "_": "Mostrar %d registros"
            },
            "pdf": "PDF",
            "print": "Imprimir",
            "createState": "Criar estado",
            "removeAllStates": "Remover todos os estados",
            "removeState": "Remover",
            "renameState": "Renomear",
            "savedStates": "Estados salvos",
            "stateRestore": "Estado %d",
            "updateState": "Atualizar"
        },
        "autoFill": {
            "cancel": "Cancelar",
            "fill": "Preencher todas as células com",
            "fillHorizontal": "Preencher células horizontalmente",
            "fillVertical": "Preencher células verticalmente"
        },
        "lengthMenu": "Exibir _MENU_ resultados por página",
        "searchBuilder": {
            "add": "Adicionar Condição",
            "button": {
                "0": "Construtor de Pesquisa",
                "_": "Construtor de Pesquisa (%d)"
            },
            "clearAll": "Limpar Tudo",
            "condition": "Condição",
            "conditions": {
                "date": {
                    "after": "Depois",
                    "before": "Antes",
                    "between": "Entre",
                    "empty": "Vazio",
                    "equals": "Igual",
                    "not": "Não",
                    "notBetween": "Não Entre",
                    "notEmpty": "Não Vazio"
                },
                "number": {
                    "between": "Entre",
                    "empty": "Vazio",
                    "equals": "Igual",
                    "gt": "Maior Que",
                    "gte": "Maior ou Igual a",
                    "lt": "Menor Que",
                    "lte": "Menor ou Igual a",
                    "not": "Não",
                    "notBetween": "Não Entre",
                    "notEmpty": "Não Vazio"
                },
                "string": {
                    "contains": "Contém",
                    "empty": "Vazio",
                    "endsWith": "Termina Com",
                    "equals": "Igual",
                    "not": "Não",
                    "notEmpty": "Não Vazio",
                    "startsWith": "Começa Com",
                    "notContains": "Não contém",
                    "notStarts": "Não começa com",
                    "notEnds": "Não termina com"
                },
                "array": {
                    "contains": "Contém",
                    "empty": "Vazio",
                    "equals": "Igual à",
                    "not": "Não",
                    "notEmpty": "Não vazio",
                    "without": "Não possui"
                }
            },
            "data": "Data",
            "deleteTitle": "Excluir regra de filtragem",
            "logicAnd": "E",
            "logicOr": "Ou",
            "title": {
                "0": "Construtor de Pesquisa",
                "_": "Construtor de Pesquisa (%d)"
            },
            "value": "Valor",
            "leftTitle": "Critérios Externos",
            "rightTitle": "Critérios Internos"
        },
        "searchPanes": {
            "clearMessage": "Limpar Tudo",
            "collapse": {
                "0": "Painéis de Pesquisa",
                "_": "Painéis de Pesquisa (%d)"
            },
            "count": "{total}",
            "countFiltered": "{shown} ({total})",
            "emptyPanes": "Nenhum Painel de Pesquisa",
            "loadMessage": "Carregando Painéis de Pesquisa...",
            "title": "Filtros Ativos",
            "showMessage": "Mostrar todos",
            "collapseMessage": "Fechar todos"
        },
        "thousands": ".",
        "datetime": {
            "previous": "Anterior",
            "next": "Próximo",
            "hours": "Hora",
            "minutes": "Minuto",
            "seconds": "Segundo",
            "amPm": [
                "am",
                "pm"
            ],
            "unknown": "-",
            "months": {
                "0": "Janeiro",
                "1": "Fevereiro",
                "10": "Novembro",
                "11": "Dezembro",
                "2": "Março",
                "3": "Abril",
                "4": "Maio",
                "5": "Junho",
                "6": "Julho",
                "7": "Agosto",
                "8": "Setembro",
                "9": "Outubro"
            },
            "weekdays": [
                "Domingo",
                "Segunda-feira",
                "Terça-feira",
                "Quarta-feira",
                "Quinte-feira",
                "Sexta-feira",
                "Sábado"
            ]
        },
        "editor": {
            "close": "Fechar",
            "create": {
                "button": "Novo",
                "submit": "Criar",
                "title": "Criar novo registro"
            },
            "edit": {
                "button": "Editar",
                "submit": "Atualizar",
                "title": "Editar registro"
            },
            "error": {
                "system": "Ocorreu um erro no sistema (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">Mais informações<\/a>)."
            },
            "multi": {
                "noMulti": "Essa entrada pode ser editada individualmente, mas não como parte do grupo",
                "restore": "Desfazer alterações",
                "title": "Multiplos valores",
                "info": "Os itens selecionados contêm valores diferentes para esta entrada. Para editar e definir todos os itens para esta entrada com o mesmo valor, clique ou toque aqui, caso contrário, eles manterão seus valores individuais."
            },
            "remove": {
                "button": "Remover",
                "confirm": {
                    "_": "Tem certeza que quer deletar %d linhas?",
                    "1": "Tem certeza que quer deletar 1 linha?"
                },
                "submit": "Remover",
                "title": "Remover registro"
            }
        },
        "decimal": ",",
        "stateRestore": {
            "creationModal": {
                "button": "Criar",
                "columns": {
                    "search": "Busca de colunas",
                    "visible": "Visibilidade da coluna"
                },
                "name": "Nome:",
                "order": "Ordernar",
                "paging": "Paginação",
                "scroller": "Posição da barra de rolagem",
                "search": "Busca",
                "searchBuilder": "Mecanismo de busca",
                "select": "Selecionar",
                "title": "Criar novo estado",
                "toggleLabel": "Inclui:"
            },
            "duplicateError": "Já existe um estado com esse nome",
            "emptyError": "Não pode ser vazio",
            "emptyStates": "Nenhum estado salvo",
            "removeConfirm": "Confirma remover %s?",
            "removeError": "Falha ao remover estado",
            "removeJoiner": "e",
            "removeSubmit": "Remover",
            "removeTitle": "Remover estado",
            "renameButton": "Renomear",
            "renameLabel": "Novo nome para %s:",
            "renameTitle": "Renomear estado"
        }
      }

      
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
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
                    <table class="table table_base" id="example" name="example">
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