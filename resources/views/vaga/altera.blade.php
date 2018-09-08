@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Vaga: {{$v->titulo}}</h1>
	<form action="/vagas/atualiza" method="post">
		<input type="hidden"
			name="_token" value="{{{ csrf_token() }}}" />
		<input type="hidden" name="id" value="{{$v->id}}"/>
		<h2>Dados gerais</h2>
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="form-group">
			<label>Titulo</label><br> 
			<input name="titulo" value="{{$v->titulo}}" size="150">
		</div>
		<div class="form-group">
			<label>Descrição</label> <br>
			<textarea name="descricao" value="{{$v->descricao}}" rows="10" cols="25"></textarea>
		</div>
		<div class="form-group">
			<label>Período</label><br>
			<select name="periodo">
				@if ($v->periodo == 'matutino')
					<option value="matutino" selected="selected">Matutino</option>
				@else
					<option value="matutino">Matutino</option>
				@endif

				@if ($v->periodo == 'diurno')
					<option value="diurno" selected="selected">Diurno</option>
				@else
					<option value="diurno">Diurno</option>
				@endif

				@if ($v->periodo == 'vespertino')
					<option value="vespertino" selected="selected">Vespertino</option>
				@else
					<option value="vespertino">Vespertino</option>
				@endif

				@if ($v->periodo == 'noturno')
					<option value="noturno" selected="selected">Noturno</option>
				@else
					<option value="noturno">Noturno</option>
				@endif
				
			</select>
		</div>
		
		<div class="form-group">
			<label>Início</label><br>
			<input name="inicio" type="date" value="{{$v->inicio}}">
		</div>

		<div class="form-group">
			<label>Fim</label><br>
			<input name="fim" type="date" value="{{$v->fim}}">
		</div>
		<div class="form-group">
			<label>Início Oferta</label><br>
			<input name="inioferta" value="{{$v->inioferta}}" type="date">
		</div>

		<div class="form-group">
			<label>Fim Oferta</label><br>
			<input name="fimoferta" value="{{$v->fimoferta}}" type="date">
		</div>

		<div class="form-group">
			<label>Salário</label><br>
			<input name="salario" value="{{$v->salario}}">
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn
			btn-primary ">OK</button>
		</div>
	</form>
</div>
@stop
