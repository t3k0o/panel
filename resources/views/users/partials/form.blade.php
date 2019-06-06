<div class="form-group">
	{{ Form::label('user', 'Nombre de usuario') }}
	{{ Form::text('user', null, ['class' => 'form-control', 'id' => 'user']) }}

    {{ Form::label('nickname', 'Nickname de usuario') }}
	{{ Form::text('nickname', null, ['class' => 'form-control', 'id' => 'nickname']) }}
</div>
<hr>
<h3>Lista de roles</h3>
<div class="form-group">
	<ul class="list-unstyled">
		@foreach($roles as $role)
	    <li>
	        <label>
	        {{ Form::checkbox('roles[]', $role->id, null) }}
	        {{ $role->name }}
	        <em>({{ $role->description ? : 'N/A'}})</em>
	        </label>
	    </li>
	    @endforeach
    </ul>
</div>
<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>