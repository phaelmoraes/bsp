@extends('layouts.app')

@push('script-fisrt')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-outline card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Editar Rota</h3>
                        <div class="card-tools">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <!-- Here is a label for example -->
                      <i class="fas fa-minus"></i>
                        </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <form action="/region/edit/{{$region->id}}" method="POST">
                      @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="route">Rota</label>
                                <input type="text" class="form-control" id="route" name="route" value="{{$region->name}}" required>
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
            </div>

            <div class="col-sm-6">
            </div>
        </div>
    </div>
</div>













    

    

@endsection