@extends('layouts.app')
@section('content')
@if(empty($diferenciais))
	<div>Não existem diferenciais cadastrados</div>
@else

	<div class="container">
		<h1>Diferenciais cadastrados</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>ID</b></td>
				<td><b>Descrição</b></td>
			</tr>
			@foreach ($diferenciais as $d)
				<tr>
					<td>{{$d->id}} </td>
					<td>{{$d->descricao}}</td>
				</tr> 
				
					
			@endforeach
		</table>
	</div>
@endif
@stop