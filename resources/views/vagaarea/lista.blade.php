@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Áreas cadastradas para {{$vaga->titulo}}</h1>
	
	<table class="table table-striped table-bordered table-hover">
		<tr style="background-color:#B0C4DE">
			<!--<td><b>ID</b></td>-->
			<td><b>Descrição</b></td>
			<td><b>Remover</b></td>
		</tr>
		@foreach ($vagaareas as $va) 
			<tr>
				<!--<td>{{$va->id}} </td>-->
				<td>{{$va->descricao}}</td>
				<td><a href="{{action('VagaAreaController@confirmaExclusao', $va->id)}}" ><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
		@endforeach
	</table>
	
	<div class="form-group">
		<td><a href="/vagaarea/nova/{{$vaga->id}}" class="btn btn-primary">Nova <span class="glyphicon glyphicon-plus"></span></a></td>
	</div>
</div>
@stop