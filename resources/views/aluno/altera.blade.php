@extends('layouts.app')
@section('content')
<div class="container">
	<div>
		<h1>Dados do aluno: {{$a->nome}}</h1>
	</div>
	
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form action="/alunos/atualiza" method="post">
		<input type="hidden"
			name="_token" value="{{{ csrf_token() }}}" />
		<input type="hidden" name="id" value="{{$a->id}}"/>
		<input type="hidden" name="usuario" value="{{$a->id_user}}"/>

		@role('Admin')
			<div class="form-group">
				<label>RA</label><br>
				<input name="ra" value="{{$a->ra}}" type="integer">
			</div>
		@endrole
		@role('Aluno')
			<div class="form-group">
				<label>RA</label><br>
				<input name="ra" value="{{$a->ra}}" readonly="readonly" type="integer">
			</div>
		@endrole
		<div class="form-group">
			<label>Nome</label><br>
			<input name="nome" value="{{$a->nome}}" size="150">
		</div>
		<div class="form-group">
			<label>Data de Nascimento</label><br>
			<input name="dt_nasc" type="date" value="{{$a->dt_nasc}}">
		</div>
		<div class="form-group">
			<label>Telefone</label><br>
			<input name="ddd" size="2" type="integer" value="{{$a->ddd}}"><input name="telefone" type="integer" value="{{$a->telefone}}">
		</div>
		
		@role('Admin')
			<div class="form-group">
				<label>Curso</label><br>
				<select name="id_curso" value="{{$a->id_curso}}">
					@foreach ($curso as $c)
					    @if($c->id == $a->id_curso)
					    	<option value="{{$c->id}}" selected="selected">{{$c->descricao}}</option>
					    @else
							<option value="{{$c->id}}">{{$c->descricao}}</option>
						@endif
					@endforeach
				</select>
			</div>	
		@endrole
		@role('Aluno')
			<div class="form-group">
				<label>Curso</label><br>
				<select name="id_curso" value="{{$a->id_curso}}" readonly="readonly">
					<option value="{{$curso->id}}" selected="selected">{{$curso->descricao}}</option>
				</select>
			</div>
			
			
		@endrole
		<div class="form-group">
			<button type="submit" class="btn
			btn-primary ">OK</button>

			@role('Aluno')
				<a href="/aluno/detalhes/{{$a->id}}" class="btn btn-primary">Perfil Completo <span class="glyphicon glyphicon-user"></span></a>
			@endrole
		</div>
	</form>
</div>
@stop
