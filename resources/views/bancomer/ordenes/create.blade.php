@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-11 mb-5 mb-xl-0 mx-auto">
          <div class="card shadow">
            <div class="card panel-default">
                <div class="card-heading">
                    <p class="text-center">Orden</p>  
                </div>
                <div class="card-body">
                {{ Form::open(['route' => 'bancomer.ordenes.store']) }}

                    @include('bancomer.ordenes.partials.form')

                {{ Form::close() }}
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection