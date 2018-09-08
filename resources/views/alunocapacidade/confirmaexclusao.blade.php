@extends('layouts.app')
@section('content')
<form action="/alunocapacidade/remove/{{$id}}" method="get" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label>Confirma exclusão da capacidade: {{$descricao}} do seu perfil?</label>
	</div>

	<div>
		<button type="submit" class="btn
		btn-primary ">Sim</button>

		<button type="button" class="btn
		btn-primary " onClick="history.go(-1)">Não</button>
	</div>
	
</form>
@stop