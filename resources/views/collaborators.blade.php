@extends('layouts.app')

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
                    <h3 class="card-title">Cadastro de Colaboradores</h3>
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
                    <form action="/collaborators" method="POST">
                      @csrf
                      <div class="form-row">
                        <div class="col">
                        <label for="name">Nome</label>
                          <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col">
                        <label for="lastName">email</label>
                          <input type="text" maxlength="50" class="form-control" id="email" name="email"/>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col">
                        <label for="name">Senha</label>
                          <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col">
                            <label for="lastName">Função</label>
                            <select class="form-select" aria-label="Default select example" id="function" name="function">
                              <option selected value="Administrator">Administrador</option>
                              <option value="Collaborator">Colaborador</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="lastName">Rota</label>
                            <select class="form-select" aria-label="Default select example" id="region" name="region">
                              <option value="" selected>Gerência</option>
                              @foreach($regions as $region)
                                <option value="{{$region->id}}">{{$region->name}}</option>
                              @endforeach
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
                    <h3 class="card-title">Lista de Colaboradores</h3>
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
                        @foreach($users as $user)
                        <tr>
                          <td>{{$user->name}}</td>
                          <td>
                          <a href="{{url('collaborator/'.$user->id)}}"class="btn btn-primary btn-sm">Editar informações</a>
                            <button type="button" class="btn btn-success btn-sm">Empréstimos</button>
                          </td>
                        </tr>
                        @endforeach

                        
                      </tbody>
                    </table>
                    
                    {{$users->links()}}
                    

                  </div>
                  
                  <div class="card-footer">
                    <!-- /.card-footer -->
                  </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Cadastro de Rotas</h3>
                        <div class="card-tools">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <!-- Here is a label for example -->
                      <i class="fas fa-minus"></i>
                        </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <form action="/region" method="POST">
                      @csrf
                      <div class="form-row">
                        <div class="col">
                        <label for="route">Nome</label>
                          <input type="text" class="form-control" id="route" name="route" required>
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
                    <h3 class="card-title">Lista de Rotas</h3>
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
                          <th scope="col">Colaborador</th>
                          <th scope="col">Opções</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach($regions as $region)
                        <tr>
                          <td>{{$region->name}}</td>
                          <td>
                            @foreach($region->collaborator as $names)
                              {{$names->name}}</br>
                            @endforeach
                          </td>

                          <td>
                            <a href="{{url('region/'.$region->id)}}"class="btn btn-primary btn-sm">Editar</a>
                            <button type="button" class="btn btn-success btn-sm">Empréstimos</button>
                          </td>
                        </tr>
                        @endforeach

                        
                      </tbody>
                    </table>
                    
                    {{$users->links()}}
                    

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