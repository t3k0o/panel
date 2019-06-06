@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-11 mb-5 mb-xl-0 mx-auto">
          <div class="card shadow">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Etiquetas
                    @can('bancomer.etiqueta.create')
                    <a href="{{ route('bancomer.etiqueta.create') }}" 
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
                            @foreach($etiquetas as $e)
                            <tr>
                                <td>{{ $e->id }}</td>
                                <td>{{ $e->descripcion }}</td>
                                <td>{{ $e->tipo }}</td>
                                @can('bancomer.etiqueta.show')
                                <td width="10px">
                                    <a href="{{ route('bancomer.etiqueta.show', $e->id) }}" 
                                    class="btn btn-sm btn-primary">
                                        ver
                                    </a>
                                </td>
                                @endcan
                                @can('bancomer.etiqueta.edit')
                                <td width="10px">
                                    <a href="{{ route('bancomer.etiqueta.edit', $e->id) }}" 
                                    class="btn btn-sm btn-success">
                                        editar
                                    </a>
                                </td>
                                @endcan
                                @can('bancomer.etiqueta.destroy')
                                <td width="10px">
                                    {!! Form::open(['route' => ['bancomer.etiqueta.destroy', $e->id], 
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
                    {{ $etiquetas->render() }}
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection