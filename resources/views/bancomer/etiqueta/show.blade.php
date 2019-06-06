@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-xl-11 mb-5 mb-xl-0 mx-auto">
          <div class="card shadow">
            <div class="card panel-default">
                <div class="card-heading">
                    <p class="text-center">Etiqueta</p>  
                </div>
                <div class="card-body">
                    <p><strong class="font-weight-bold">ID</strong>               {{ $etiqueta->id }}</p>
                    <p><strong class="font-weight-bold">Descripción</strong>      {{ $etiqueta->descripcion }}</p>
                    <p><strong class="font-weight-bold">Tipo</strong>             {{ $etiqueta->tipo }}</p>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection