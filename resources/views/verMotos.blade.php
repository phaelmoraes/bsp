@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="lightbox/css/vlightbox1.css" type="text/css" />
    <link rel="stylesheet" href="lightbox/css/visuallightbox.css" type="text/css" media="screen" />
@endpush
@push('script-fisrt')
    <script src="lightbox/js/jquery.min.js" type="text/javascript"></script>
    <script src="lightbox/js/visuallightbox.js" type="text/javascript"></script>
    <script src="lightbox/js/thumbscript1.js" type="text/javascript"></script>
    <script src="lightbox/js/vlbdata1.js" type="text/javascript"></script>

@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Detalhes da Moto</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                        </div>
                  </div>
                  <div class="card-body">
                    
                    <div id="vlightbox1">
                        @foreach($fotos as $foto)
                        {{ asset($foto->caminho) }}
                            <img src="{{ asset($foto->caminho) }}" alt="foto">
                        @endforeach
                    </div>

                  </div>

                </div>
            </div>
        </div>
        
    </div>
@endsection