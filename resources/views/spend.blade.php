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
        
        $('#example2').DataTable({
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

            
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

        $('#example').DataTable({
            "paging": true,
            "lengthChange": true,
            "pageLength": 5,
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

            
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
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
                        <h3 class="card-title">Cadastrar Gastos</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <!-- Here is a label for example -->
                            <i class="fas fa-minus"></i>
                                </div>
                            <!-- /.card-tools -->
                        </div>
                    <div class="card-body">
                        <form action="{{route('spendAdd')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <div class="col-sm-6">
                                    <label for="lastName">Colaborador</label>
                                    <input type="text" class="form-control" id="collaborator" name="collaborator" value="{{ Auth::user()->name }}" readonly/>
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{ Auth::user()->id }}"/>
                                </div>

                                <div class="col-sm-6">
                                    <label for="name">Valor</label>
                                    <input type="text" size="12" onKeyUp="mascaraMoeda(this, event)" class="form-control" id="price" name="price" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="col">
                                    <label for="desc" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                    </form>
                </div>
            </div>

            @if( Auth::user()->function == "Administrator")
            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Gastos em análise</h3>
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
                                <th scope="col">Valor</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Rota</th>
                                <th scope="col">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allSpend as $spendAll)
                            <tr>
                                <td>{{ $spendAll->collaborator($spendAll->user_id)->name }}</td>
                                <td>R$ {{ number_format($spendAll->price,2,",",".") }}</td>
                                <td>{{ $spendAll->description }}</td>
                                <td>{{  $spendAll->region($spendAll->region_id)->name }}</td>
                                <td>
                                    <a href="{{url('spend/accepted/'.$spendAll->id)}}" class="btn btn-success btn-sm">Aprovar</a>
                                    <a href="{{url('spend/denied/'.$spendAll->id)}}"class="btn btn-danger btn-sm">Negar</a>
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
            @endif
        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Gastos em análise</h3>
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
                                <th scope="col">Valor</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Rota</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($analyze as $analyzed)
                            <tr>
                                <td>R$ {{ number_format($analyzed->price,2,",",".") }}</td>
                                <td>{{ $analyzed->description }}</td>    
                                <td>{{ $analyzed->region($analyzed->region_id)->name }}</td>
                            </tr>
                            @endforeach


                            
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Gastos Analizados</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <!-- Here is a label for example -->
                            <i class="fas fa-minus"></i>
                                </div>
                            <!-- /.card-tools -->
                        </div>
                    <div class="card-body">
                        <table class="table table_base" id="example2" name="example2">
                            <thead>

                            <tr>
                                <th scope="col">Valor</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Status</th>
                                <th scope="col">Rota</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($spend as $spending)
                            <tr>
                                <td>R$ {{ number_format($spending->price,2,",",".") }}</td>
                                <td>{{ $spending->description }}</td>
                                <td>
                                    @if($spending->status == 'accepted')
                                        <span class="badge bg-success text-light" >Aceito</span> 
                                    @else
                                        <span class="badge bg-danger text-light" >Negado</span>
                                    @endif
                                </td>
                                <td>{{ $spending->region($spending->region_id)->name }}</td>
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
        </div>
    </div>
</div>
@endsection