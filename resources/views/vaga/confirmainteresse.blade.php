@extends('layouts.app')
@section('content')
<form action="/vagas/registrainteresse/{{$vaga->id}}" method="get" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label>Confirma interesse na vaga: {{$vaga->titulo}}?</label>
	</div>
	<div class="form-group">
		<button type="submit" class="btn
		btn-primary ">Sim</button>

		<button type="button" class="btn
		btn-primary " onClick="history.go(-1)">Não</button>	
	</div>
	
</form>
@stop