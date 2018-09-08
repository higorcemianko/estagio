@extends('layouts.app')
@section('content')
@if(empty($capacidades))
	<div>Não existem capacidades cadastradas</div>
@else

	<div class="container">
		<h1>Capacidades cadastradas</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>ID</b></td>
				<td><b>Descrição</b></td>
			</tr>
			@foreach ($capacidades as $c) 
				<tr>
					<td>{{$c->id}} </td>
					<td>{{$c->descricao}}</td>
				</tr>
				
					
			@endforeach
		</table>
	</div>
@endif
@stop