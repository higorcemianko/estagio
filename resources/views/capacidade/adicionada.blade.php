@extends('layouts.app')
@section('content')
<form action="/capacidades/lista" method="get" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label>Capacidade {{ old('descrição') }} adicionada!</label>
	</div>
	<button type="submit" class="btn
	btn-primary ">OK</button>
</form>
@stop