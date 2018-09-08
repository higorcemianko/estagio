@extends('layouts.app')
@section('content')
<form action="/alunos/lista" method="get" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label>{{$mensagem}}</label>
	</div>
	<button type="button" class="btn
		btn-primary " onClick="history.go(-1)">OK</button>
</form>
@stop