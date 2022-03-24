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
                    <table class="table table_base" id="table_base" name="table_base">
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
                    
                    {{$consumers->links()}}
                    

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