@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Diferenciais cadastradas para {{$aluno->nome}}</h1>
	<table class="table table-striped table-bordered table-hover">
		<tr style="background-color:#B0C4DE">
			<!--<td><b>ID</b></td>-->
			<td><b>Descrição</b></td>
			<td><b>Remover</b></td>
		</tr>
		@foreach ($alunodiferenciais as $ad) 
			<tr>
				<!--<td>{{$ad->id_diferencial}} </td>-->
				<td>{{$ad->descricao}} </td>
				<td><a href="{{action('AlunoDiferencialController@confirmaExclusao', $ad->id)}}" ><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
		@endforeach
	</table>
	

	<div class="container">
		<td><a href="/alunodiferencial/nova/{{$aluno->id}}" class="btn btn-primary">Novo <span class="glyphicon glyphicon-plus"></span></a></td>
	</div>
</div>
@stop