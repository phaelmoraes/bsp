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
                    <h3 class="card-title">Informações Cadastrais</h3>
                        <div class="card-tools">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <!-- Here is a label for example -->
                      <i class="fas fa-minus"></i>
                        </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    @if($errors->any())
                    <ul class="list-group">
                      @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-warning">{{Error}}</li>
                      @endforeach

                    </ul>
                    @endif

                    <form action="/consumer/edit/{{$consumer->id}}" method="POST">
                      @csrf
                      <div class="form-row">
                        <div class="col">
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$consumer->id}}">
                        <label for="name">Nome</label>
                          <input type="text" class="form-control" id="name" name="name" value="{{$consumer->name}}" required>
                        </div>
                        <div class="col">
                        <label for="lastName">CPF/CNPJ</label>
                            @if($consumer->type == "PF")
                                <input type="text" onkeypress="mascaraMutuario(this,cpfCnpj)" onblur="clearTimeout()" maxlength="18" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="{{$consumer->cpf}}"/>
                            @else
                                <input type="text" onkeypress="mascaraMutuario(this,cpfCnpj)" onblur="clearTimeout()" maxlength="18" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="{{$consumer->cnpj}}"/>
                            @endif

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
                        @foreach($contacts as $contact)
                            <div class="form-row col-sm-12">
                                <div class="col-sm-6">
                                    <label for="phone">Número</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$contact->phone}}" name="cpf_cnpj" readonly/>
                                </div>

                                <div class="col-sm-3">
                                    <label for="type">Tipo</label>
                                    <input type="text" class="form-control" id="type" name="type" value="{{$contact->type}}" name="type" readonly/>
                                </div>      
                            </div>
                            <div class="col-sm-3">
                                <a href="{{url('contact/'.$contact->id).'/'.$consumer->id}}"class="btn btn-danger btn-sm">Deletar</a>
                            </div>
                        @endforeach
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email"  value="{{$consumer->email}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="birth">Data de Nascimento</label>
                          <input type="date" class="form-control" id="birth" name="birth" value="{{$consumer->birthday}}">
                        </div>
                        
                        <div class="form-group col-md-3">
                          <label for="gender">Gênero</label>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="MALE" @if($consumer->gender == "MALE") checked @endif>
                            <label class="form-check-label" for="gender1">
                              Masculino
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="FEMALE"  @if($consumer->gender == "FEMALE") checked @endif>
                            <label class="form-check-label" for="gender2">
                              Feminino
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender3" value="OTHER"  @if($consumer->gender == "OTHER") checked @endif>
                            <label class="form-check-label" for="gender3">
                              Outros
                            </label>
                          </div>

                        </div>

                      </div>
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="address">Rua</label>
                            <input type="text" class="form-control" id="street" name="street" value="{{$address->street}}" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="address">Bairro</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{$address->neighborhood}}" required>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="address">Número</label>
                            <input type="text" class="form-control" id="building_number" name="building_number" value="{{$address->building_number}}">
                          </div>
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="address">Complemento</label>
                        <input type="text" class="form-control" id="complement" name="complement" value="{{$address->complement}}">
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="city">Cidade</label>
                          <input type="text" class="form-control" id="city" name="city" value="{{$address->city}}">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="city">Estado</label>
                          <input type="text" class="form-control" id="state" name="state" value="{{$address->state}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="note">Observações</label>
                        <textarea class="form-control" id="note" name="note" rows="3">{{$consumer->note}}</textarea>
                      </div>
                      
                    
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Editar</button>
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