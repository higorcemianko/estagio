@extends('layouts.app')
@section('content')


	<div class="container">
		<h1>Estágios Efetivados</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>RA Aluno</b></td>
				<td><b>Nome Aluno</b></td>
				<td><b>CNPJ</b></td>
				<td><b>Razão Social</b></td>
				<td><b>Vaga</b></td>
				<td><b>Detalhes</b></td>
			</tr>	
			@foreach ($result as $res) 
				<tr>
					<td>{{$res->ra}} </td>
					<td>{{$res->nome}}</td>
					<td>{{$res->cnpj}}</td>
					<td>{{$res->razaosocial}}</td>
					<td>{{$res->titulo}}</td>
					<td><a href="/vagas/detalhes/{{$res->id_vaga}}"><span class="glyphicon glyphicon-search"></span></a></td>
				</tr>
			@endforeach
		</table>
	</div>
	
@stop