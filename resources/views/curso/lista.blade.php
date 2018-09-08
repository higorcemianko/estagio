@extends('layouts.app')
@section('content')
@if(empty($cursos))
	<div>Não existem cursos cadastrados</div>
@else

	<div class="container">
		<h1>Cursos cadastrados</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>Código</b></td>
				<td><b>Descrição</b></td>
			</tr>
			@foreach ($cursos as $c) 
				<tr>
					<td>{{$c->codigo}} </td>
					<td>{{$c->descricao}}</td>
				</tr>
			@endforeach
		</table>
	</div>
@endif
@stop