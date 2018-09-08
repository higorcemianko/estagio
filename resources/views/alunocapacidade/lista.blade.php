@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Capacidades cadastradas para {{$aluno->nome}}</h1>
	
	<table class="table table-striped table-bordered table-hover">
		<tr style="background-color:#B0C4DE">
			<!--<td><b>ID</b></td>-->
			<td><b>Descrição</b></td>
			<td><b>Remover</b></td>
		</tr>
		@foreach ($alunocapacidades as $ac) 
			<tr>
				<!--<td>{{$ac->id_capacidade}} </td>-->
				<td>{{$ac->descricao}} </td>
				<td><a href="{{action('AlunoCapacidadeController@confirmaExclusao', $ac->id)}}" ><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
		@endforeach
	</table>
	
	<div class="container">
		<td><a href="/alunocapacidade/nova/{{$aluno->id}}" class="btn btn-primary">Nova <span class="glyphicon glyphicon-plus"></span></a></td>
	</div>
</div>
@stop