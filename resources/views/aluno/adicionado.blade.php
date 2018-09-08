@extends('layouts.app')
@section('content')
<form action="/alunos/lista" method="get" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label>Aluno {{ old('nome') }} adicionado!</label>
	</div>
	<button type="submit" class="btn
	btn-primary ">OK</button>
</form>
@stop