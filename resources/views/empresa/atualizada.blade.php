@extends('layouts.app')
@section('content')
<form action="/home" method="get" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label>Empresa {{ old('razaosocial') }} atualizada!</label>
	</div>
	<button type="submit" class="btn
	btn-primary ">OK</button>
</form>
@stop