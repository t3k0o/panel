<div class="form-group">
	{{ Form::label('descripcion', 'Nombre de la orden') }}
	{{ Form::text('descripcion', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	<input type="hidden" name="tipo" value="Bancomer" id="tipo">
</div>
<hr>

<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>