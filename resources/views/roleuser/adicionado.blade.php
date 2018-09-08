@extends('layouts.app')
@section('content')
<form action="/roleuser/novo" method="get" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label>Papel adicionado!</label>
	</div>
	<button type="submit" class="btn
	btn-primary ">OK</button>
</form>
@stop