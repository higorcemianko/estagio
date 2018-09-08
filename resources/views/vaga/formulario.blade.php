@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Nova vaga</h1>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form action="/vagas/adiciona" method="post">
		<input type="hidden"
			name="_token" value="{{{ csrf_token() }}}" />
		<div class="form-group">
			<label>Titulo</label><br>
			<input name="titulo" size="150">
		</div>
		<div class="form-group">
			<label>Descrição</label><br>
			<textarea name="descricao" rows="10" cols="25"></textarea>
		</div>
		<div class="form-group">
			<label>Período</label><br>
			<select name="periodo">
				<option value="matutino">Matutino</option>
				<option value="diurno">Diurno</option>
				<option value="vespertino">Vespertino</option>
				<option value="noturno">Noturno</option>
			</select>
		</div>

		<div class="form-group">
			<label>Início</label><br>
			<input name="inicio" type="date">
		</div>

		<div class="form-group">
			<label>Fim</label><br>
			<input name="fim" type="date">
		</div>

		<div class="form-group">
			<label>Início Oferta</label><br>
			<input name="inioferta" type="date">
		</div>

		<div class="form-group">
			<label>Fim Oferta</label><br>
			<input name="fimoferta" type="date">
		</div>

		<div class="form-group">
			<label>Salário</label><br>
			<input name="salario">
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn
			btn-primary ">OK</button>
		</div>
	</form>
</div>

@stop