@extends('layouts.app')
@section('content')
<form action="/cursos/lista" method="get" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label>Curso {{ old('descricao') }} adicionado!</label>
	</div>
	<button type="submit" class="btn
	btn-primary ">OK</button>
</form>
@stop