@extends('layouts.app')
@section('content')
<form action="/vagaarea/adiciona/{{$v}}" method="post" align="center">
	<input type="hidden"
		name="_token" value="{{{ csrf_token() }}}" />
	
	<div class="form-group">
		<label>Área</label>
		<select name="area">
			@foreach ($areas as $a)
				<option value="{{$a->id}}" size="100">{{$a->descricao}}</option>
			@endforeach
		</select>
	</div>
	<button type="submit" class="btn
	btn-primary ">OK</button>
</form>
@stop