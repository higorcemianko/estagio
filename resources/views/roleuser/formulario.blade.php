@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Novo papel</h1>
	<form action="/roleuser/adiciona" method="post">
		<input type="hidden"
			name="_token" value="{{{ csrf_token() }}}" />
		<div class="form-group">
			<label>Usuário</label><br>
			<select name="user">
				@foreach ($users as $u)
					<option value="{{$u->id}}">{{$u->name}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label>Papel</label><br>
			<select name="role">
				@foreach ($roles as $r)
					<option value="{{$r->id}}">{{$r->name}}</option>
				@endforeach
			</select>
		</div>

		<button type="submit" class="btn
		btn-primary">OK</button>
	</form>
</div>

@stop