@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-xl-11 mb-5 mb-xl-0 mx-auto">
          <div class="card shadow">
            <div class="card panel-default">
                <div class="card-heading">
                    <p class="text-center">Roles</p>  
                </div>
                <div class="card-body">
                    <p><strong>Nombre</strong>     {{ $role->name }}</p>
                    <p><strong>Slug</strong>      {{ $role->slug }}</p>
                    <p><strong>Descripción</strong>      {{ $role->description }}</p>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection