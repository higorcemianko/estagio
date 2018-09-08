@extends('layouts.app')
@section('content')
@if(empty($alunos))
	<div align="center"><b>Não existem alunos!</b></div>
@else

	<div class="container">
		<h1>{{$mensagem}}</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>RA</b></td>
				<td><b>Nome</b></td>
				<td><b>Data de Nascimento</b></td>
				<td><b>Curso</b></td>
				<td><b>Telefone</b></td>
				@role('Admin')
					<td><b>Editar</b></td>
					<td><b>Remover</b></td>
				@endrole
				@role('Empresa')
					<td><b>Perfil</b></td>
				@endrole
			</tr>
			@foreach ($alunos as $a) 
				<tr>
					<td>{{$a->ra}} </td>
					<td>{{$a->nome}}</td>
					<td>{{$a->dt_nasc}}</td>
					<td>{{$a->descricao}}</td>
					<td>{{$a->ddd}} - {{$a->telefone}}</td>
					@role('Admin')
						<td><a href="/alunos/altera/{{$a->id}}"><span class="glyphicon glyphicon-search"></span></a></td>
						<td><a href="/alunos/confexcl/{{$a->id}}"><span class="glyphicon glyphicon-trash"></span></a></td>
					@endrole
					@role('Empresa')
						<td><a href="/aluno/detalhes/{{$a->id}}"><span class="glyphicon glyphicon-search"></span></a></td>
					@endrole
				</tr>
			@endforeach
		</table>
	</div>
@endif
@stop