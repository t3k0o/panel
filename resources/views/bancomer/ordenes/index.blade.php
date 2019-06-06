@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-11 mb-5 mb-xl-0 mx-auto">
          <div class="card shadow">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ordenes
                    @can('bancomer.ordenes.create')
                    <a href="{{ route('bancomer.ordenes.create') }}" 
                    class="btn btn-sm btn-primary float-right">
                        Crear
                    </a>
                    @endcan
                </div>

                <div class="panel-body">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th >Descripción</th>
                                <th >Tipo</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordenes as $o)
                            <tr>
                                <td>{{ $o->id }}</td>
                                <td>{{ $o->descripcion }}</td>
                                <td>{{ $o->tipo }}</td>
                                @can('bancomer.ordenes.show')
                                <td width="10px">
                                    <a href="{{ route('bancomer.ordenes.show', $o->id) }}" 
                                    class="btn btn-sm btn-primary">
                                        ver
                                    </a>
                                </td>
                                @endcan
                                @can('bancomer.ordenes.edit')
                                <td width="10px">
                                    <a href="{{ route('bancomer.ordenes.edit', $o->id) }}" 
                                    class="btn btn-sm btn-success">
                                        editar
                                    </a>
                                </td>
                                @endcan
                                @can('bancomer.ordenes.destroy')
                                <td width="10px">
                                    {!! Form::open(['route' => ['bancomer.ordenes.destroy', $o->id], 
                                    'method' => 'DELETE']) !!}
                                        <button class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    {!! Form::close() !!}
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $ordenes->render() }}
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection