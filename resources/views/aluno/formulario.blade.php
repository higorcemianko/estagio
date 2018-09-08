@extends('layouts.app')
@section('content')
<div  class="container">
	<div>
		<h1>Novo aluno</h1>
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
	<form action="/alunos/adiciona" method="post">
		<input type="hidden"
			name="_token" value="{{{ csrf_token() }}}" />
		<div class="form-group">
			<label>RA</label><br>
			<input name="ra" type="integer"> 
		</div>
		
		<div class="form-group">
			<label>Nome</label><br>
			<input name="nome" size="150">
		</div>

		<div class="form-group">
			<label>Data de Nascimento</label><br>
			<input name="dt_nasc" type="date">
		</div>

		<div class="form-group">
			<label>Telefone</label><br>
			<input name="ddd" size="2" type="integer">  <input name="telefone" size="integer">
		</div>
		
		<div class="form-group">
			<label>Curso</label><br>
			<select name="id_curso">
				@foreach ($cursos as $c)
					<option value="{{$c->id}}">{{$c->descricao}}</option>
				@endforeach
			</select>
		</div>
						
		@role('Admin')
			<div class="form-group">
				<label>Usuário</label><br>
				<select name="usuario">
					@foreach ($users as $u)
						<option value="{{$u->id}}">{{$u->name}}</option>
					@endforeach
				</select>
			</div>
		@endrole
		<div class="form-group">
			<button type="submit" class="btn
			btn-primary ">OK</button>
		</div>
	</form>
</div>

@stop