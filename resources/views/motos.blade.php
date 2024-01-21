@extends('layouts.app')

@push('script-fisrt')

@endpush

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Motos Cadastradas</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                        </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Fabricante</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Ano</th>
                                <th scope="col">Quilometragem</th>
                                <th scope="col">Cilindrada</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($motos as $moto)
                            <tr>
                                <th scope="row">{{$moto->id}}</th>
                                <th scope="row">{{$moto->fabricante->fabricante}}</th>
                                <th scope="row">{{$moto->modelo}}</th>
                                <th scope="row">{{$moto->ano}}</th>
                                <th scope="row">{{$moto->km}}</th>
                                <th scope="row">{{$moto->cilindrada}}</th>
                                <th><a class="btn btn-primary" href="{{url('moto/'.$moto->id)}}" role="button">Detalhes</a></th>

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