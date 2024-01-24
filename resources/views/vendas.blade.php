@extends('layouts.app')

@push('script-fisrt')

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

<script>
    $(document).ready(function () {
        $('#buscarMotosForm').submit(function (e) {
            e.preventDefault();

            var loja = $('#loja').val();
            var fabricante = $('#fabricante').val();

            if (loja === '' && fabricante === '0') {
                // Ambos os campos estão em "Todos", então não envie nenhum parâmetro
                window.location.href = "{{ route('buscar_motos', ['loja' => Auth::user()->loja_id, 'fabricante' => 0]) }}";
            } else if (loja !== '' && fabricante === '0') {
                // Somente loja é selecionada
                window.location.href = "{{ route('buscar_motos', ['loja' => ':loja', 'fabricante' => 0]) }}".replace(':loja', loja);
            } else if (loja === '' && fabricante !== '0') {
                // Somente fabricante é selecionado
                window.location.href = "{{ route('buscar_motos', ['loja' => Auth::user()->loja_id, 'fabricante' => ':fabricante']) }}".replace(':fabricante', fabricante);
            } else {
                // Ambos os campos são selecionados
                window.location.href = "{{ route('buscar_motos', ['loja' => ':loja', 'fabricante' => ':fabricante']) }}"
                    .replace(':loja', loja)
                    .replace(':fabricante', fabricante);
            }
        });
    });
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
                <div class="card card-outline card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Vendas em aberto</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                        </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <table class="table" id="example1">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Fabricante</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Placa</th>
                                <th scope="col">Forma de Pagamento</th>
                                <th scope="col">Valor Total</th>
                                <th scope="col">Valor Pago</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Vendedor</th>
                                <th scope="col">Status</th>
                                <th scope="col">Loja</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendas as $venda)
                            <tr>
                                <th scope="row">{{$venda->id}}</th>
                                <th scope="row">{{$venda->moto->fabricante->fabricante}}</th>
                                <th scope="row">{{$venda->moto->modelo}}</th>
                                <th scope="row">{{$venda->moto->placa}}</th>
                                <th scope="row">{{$venda->forma_pagamento}}</th>
                                <th scope="row">{{number_format($venda->valor_total,2,',','.')}}</th>
                                <th scope="row">{{number_format($venda->valor_pago,2,',','.')}}</th>
                                <th scope="row">{{$venda->cliente}}</th>
                                <th scope="row">{{$venda->vendedor->name}}</th>
                                <th scope="row">{{$venda->status}}</th>
                                <th scope="row">{{$venda->loja->loja}}</th>

                                <td>
                                    <a href="{{url('vendas/'.$venda->id)}}"class="btn btn-primary btn-sm">Detalhes</a>
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