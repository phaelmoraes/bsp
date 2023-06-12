@extends('layouts.app')

@push('script-fisrt')


<script>
  
  function mascaraMutuario(o,f){
      v_obj=o
      v_fun=f
      setTimeout('execmascara()',1)
  }
  
  function execmascara(){
      v_obj.value=v_fun(v_obj.value)
  }
  
  function cpfCnpj(v){
  
      //Remove tudo o que não é dígito
      v=v.replace(/\D/g,"")
  
      if (v.length < 14) { //CPF
  
          //Coloca um ponto entre o terceiro e o quarto dígitos
          v=v.replace(/(\d{3})(\d)/,"$1.$2")
  
          //Coloca um ponto entre o terceiro e o quarto dígitos
          //de novo (para o segundo bloco de números)
          v=v.replace(/(\d{3})(\d)/,"$1.$2")
  
          //Coloca um hífen entre o terceiro e o quarto dígitos
          v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
  
      } else { //CNPJ
  
          //Coloca ponto entre o segundo e o terceiro dígitos
          v=v.replace(/^(\d{2})(\d)/,"$1.$2")
  
          //Coloca ponto entre o quinto e o sexto dígitos
          v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
  
          //Coloca uma barra entre o oitavo e o nono dígitos
          v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
  
          //Coloca um hífen depois do bloco de quatro dígitos
          v=v.replace(/(\d{4})(\d)/,"$1-$2")
  
      }
  
      return v
  
  }

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





<script>
  function formatarCampo(campoTexto) {
      if (campoTexto.value.length <= 11) {
          campoTexto.value = mascaraCpf(campoTexto.value);
      } else {
          campoTexto.value = mascaraCnpj(campoTexto.value);
      }
  }
  function retirarFormatacao(campoTexto) {
      campoTexto.value = campoTexto.value.replace(/(\.|\/|\-)/g,"");
  }
  function mascaraCpf(valor) {
      return valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g,"\$1.\$2.\$3\-\$4");
  }
  function mascaraCnpj(valor) {
      return valor.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g,"\$1.\$2.\$3\/\$4\-\$5");
  }

  //Nascimento
  function nascimento(valor) {
    document.getElementById('birth').addEventListener('input', function(e) {
      var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,2})(\d{0,4})/);
      e.target.value = !x[2] ? x[1] : x[1] + '/' + x[2] + '/' + x[3] ;
    });
  }

  var contacts = [];


  function addContact() {
    var phone = {}
      phone.number = $("#contact").val();
      phone.type = $("#typeContact").val();

      contacts.push(phone);

      $("#contact").val("");

      $("#contacts").val(JSON.stringify(contacts))
      listContacts();
  }

  function listContacts() {
      var listContact = $('#list_contact');

      $("li").remove(".list-group-item, .avatar");

      contacts.forEach((phone, index) => {
          var html = `
                  <li class="list-group-item">
                      Contato: ${phone.number}
                      <a href="javascript:void%200" onclick="deleteContact('${index}', '${phone.number}')" class="secondary-content"><i style="color:#01579b" class="material-icons">delete</i></a>
                  </li>`;
          listContact.append(html);
      });
  }

  function deleteContact(index, phone) {
      if(confirm(`Deseja remover este contato - ${phone} ?`)) {
          contacts.splice(index, 1);
          listContacts()
      }
  }
</script>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Cadastro de clientes</h3>
                        <div class="card-tools">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <!-- Here is a label for example -->
                      <i class="fas fa-minus"></i>
                        </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    @if(isset($msg))
                    <div class="alert alert-warning" role="alert">
                      {{$msg}}
                    </div>
                    @endif
                    <form action="/consumers" method="POST">
                      @csrf
                      <div class="form-row">
                        <div class="col">
                        <label for="name">Nome</label>
                          <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col">
                        <label for="lastName">CPF/CNPJ</label>
                          <input type="text" onkeypress="mascaraMutuario(this,cpfCnpj)" onblur="clearTimeout()" maxlength="18" class="form-control" id="cpf_cnpj" name="cpf_cnpj"/>
                          <!-- <input type='text' name='cpfcnpj' maxlength="18" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()'> -->

                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col">
                          <input type="hidden" name="contacts" id="contacts">

                          <div class="form-group">
                            <label for="contact">Contato</label>
                            <input type="text" class="form-control" id="contact" name="contact" maxlength="50">
                          </div>
                        </div>

                        <div class="col">

                          <div class="form-group col-md-3">
                            <label for="typeContact"  >Tipo</label>
                            <select class="form-select" id="typeContact" name="typeContact" aria-label="Default select example">
                              <option value="WHATSAPP">WhatsApp</option>
                              <option value="CELL_PHONE">Celular</option>
                              <option value="PHONE">Telefone</option>
                            </select>

                          </div>

                        </div>
                          
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-outline-success" onclick="addContact()">
                              Adicionar
                            </button>
                        </div>
                        
                        <div class="row">
                          <ul id="list_contact" class="list-group">   
                          </ul>
                        </div>

                        
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="birth">Data de Nascimento</label>
                          <input type="date" class="form-control" id="birth" name="birth">
                        </div>
                        
                        <div class="form-group col-md-3">
                          <label for="gender">Gênero</label>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="MALE" checked>
                            <label class="form-check-label" for="gender1">
                              Masculino
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="FEMALE">
                            <label class="form-check-label" for="gender2">
                              Feminino
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender3" value="OTHER">
                            <label class="form-check-label" for="gender3">
                              Outros
                            </label>
                          </div>

                        </div>

                      </div>
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="address">Rua</label>
                            <input type="text" class="form-control" id="street" name="street" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="address">Bairro</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood" required>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="address">Número</label>
                            <input type="text" class="form-control" id="building_number" name="building_number">
                          </div>
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="address">Complemento</label>
                        <input type="text" class="form-control" id="complement" name="complement">
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="city">Cidade</label>
                          <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="city">Estado</label>
                          <input type="text" class="form-control" id="state" name="state">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="note">Observações</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
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
                    <h3 class="card-title">Lista de clientes</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                        </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-hover" id="example1" name="example1">
                      <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Opções</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach($consumers as $consumer)
                        <tr>
                          <td>{{$consumer->name}}</td>
                          <td>
                            <a href="{{url('consumer/'.$consumer->id)}}"class="btn btn-primary btn-sm">Ver Dados</a>
                            <button type="button" class="btn btn-success btn-sm">Empréstimos</button>
                          </td>
                        </tr>
                        @endforeach

                        
                      </tbody>
                    </table>
                    
                    

                  </div>
                  
                  <div class="card-footer">
                    <!-- /.card-footer -->
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>













    

    

@endsection