@extends('layouts.app')
@section('content')

<div class="container">
	<h1>Novo curso</h1>
	<form action="/cursos/adiciona" method="post">
		<input type="hidden"
			name="_token" value="{{{ csrf_token() }}}" />
		<div class="form-group">
			<label>Código</label><br>
			<input name="codigo">
		</div>
		<div class="form-group">
			<label>Descrição</label><br>
			<input name="descricao">
		</div>

		<div class="form-group">
			<button type="submit" class="btn
			btn-primary ">OK</button>
		</div>
	</form>

</div>

@stop