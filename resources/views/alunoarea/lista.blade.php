@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Áreas cadastradas para {{$aluno->nome}}</h1>
	
	<table class="table table-striped table-bordered table-hover">
		<tr style="background-color:#B0C4DE">
			<!--<td><b>ID</b></td>-->
			<td><b>Descrição</b></td>
			<td><b>Remover</b></td>
		</tr>
		@foreach ($alunoareas as $aa) 
			<tr>
				<!--<td>{{$aa->id_area}} </td>-->
				<td>{{$aa->descricao}} </td>
				<td><a href="{{action('AlunoAreaController@confirmaExclusao', $aa->id)}}" ><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
		@endforeach
	</table>
	
	<div class="container">
		<td><a href="/alunoarea/nova/{{$aluno->id}}" class="btn btn-primary">Nova <span class="glyphicon glyphicon-plus"></span></a></td>
	</div>
</div>
@stop