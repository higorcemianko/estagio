@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Capacidades cadastradas para {{$vaga->titulo}}</h1>

	<table class="table table-striped table-bordered table-hover">
		<tr style="background-color:#B0C4DE">
			<!--<td><b>ID</b></td>-->
			<td><b>Descrição</b></td>
			<td><b>Remover</b></td>
		</tr>
		@foreach ($vagacapacidades as $vc) 
			<tr>
				<!--<td>{{$vc->id}} </td>-->
				<td>{{$vc->descricao}}</td>
				<td><a href="{{action('VagaCapacidadeController@confirmaExclusao', $vc->id)}}" ><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
		@endforeach
	</table>
	
	<div class="form-group">
		<td><a href="/vagacapacidade/nova/{{$vaga->id}}" class="btn btn-primary">Nova <span class="glyphicon glyphicon-plus"></span></a></td>
	</div>
</div>
@stop