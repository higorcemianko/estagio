@extends('layouts.app')
@section('content')
<form action="/vagadiferencial/adiciona/{{$v}}" method="post" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	
	<div class="form-group">
		<label>Diferencial</label>
		<select name="diferencial">
			@foreach ($diferenciais as $d)
				<option value="{{$d->id}}" size="100">{{$d->descricao}}</option>
			@endforeach
		</select>
	</div>
	<button type="submit" class="btn
	btn-primary ">OK</button>
</form>
@stop