@extends('layouts.app')
@section('content')
<form action="/areas/lista" method="get" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label>Area {{ old('descricao') }} adicionada!</label>
	</div>
	<button type="submit" class="btn
	btn-primary ">OK</button>
</form>
@stop
