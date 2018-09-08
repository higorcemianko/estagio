@extends('layouts.app')
@section('content')
<div class="container">
	<div class="form-group">
		<h1>Novo diferencial</h1>
	</div>
	<form action="/diferenciais/adiciona" method="post">
		<input type="hidden"
			name="_token" value="{{{ csrf_token() }}}" />
		
		<div class="form-group">
			<label>Descrição</label><br>
			<input name="descricao" >
		</div>

		<div class="form-group">
			<button type="submit" class="btn
			btn-primary ">OK</button>
		</div>
	</form>

</div>

@stop