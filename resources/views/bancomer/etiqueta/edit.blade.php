@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-11 mb-5 mb-xl-0 mx-auto">
          <div class="card shadow">
            <div class="card panel-default">
                <div class="card-heading">
                    <p class="text-center">Etiquetas</p>  
                </div>
                <div class="card-body">
                {!! Form::model($etiqueta, ['route' => ['bancomer.etiqueta.update', $etiqueta->id],
                    'method' => 'PUT']) !!}

                        @include('bancomer.etiqueta.partials.form')
                        
                    {!! Form::close() !!}
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection