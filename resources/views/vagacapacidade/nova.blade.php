@extends('layouts.app')
@section('content')
<form action="/vagacapacidade/adiciona/{{$v}}" method="post" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	
	<div class="form-group">
		<label>Capacidade</label>
		<select name="capacidade">
			@foreach ($capacidades as $c)
				<option value="{{$c->id}}" size="100">{{$c->descricao}}</option>
			@endforeach
		</select>
	</div>
	<button type="submit" class="btn
	btn-primary ">OK</button>
</form>
@stop