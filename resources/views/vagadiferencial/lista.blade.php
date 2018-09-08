@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Diferenciais cadastrados para {{$vaga->titulo}}</h1>
	
	<table class="table table-striped table-bordered table-hover">
		<tr style="background-color:#B0C4DE">
			<!--<td><b>ID</b></td>-->
			<td><b>Descrição</b></td>
			<td><b>Remover</b></td>
		</tr>
		@foreach ($vagadiferenciais as $vd) 
			<tr>
				<!--<td>{{$vd->id}} </td>-->
				<td>{{$vd->descricao}}</td>
				<td><a href="{{action('VagaDiferencialController@confirmaExclusao', $vd->id)}}" ><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
		@endforeach
	</table>

	<div class="form-group">
		<td><a href="/vagadiferencial/nova/{{$vaga->id}}" class="btn btn-primary">Novo <span class="glyphicon glyphicon-plus"></span></a></td>
	</div>
</div>
@stop