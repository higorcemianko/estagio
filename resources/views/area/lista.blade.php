@extends('layouts.app')
@section('content')
@if(empty($areas))
	<div>Não existem areas cadastradas</div>
@else

	<div class="container">
		<h1>Areas cadastradas</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>ID</b></td>
				<td><b>Descrição</b></td>
			</tr>

			@foreach ($areas as $a) 
				<tr>
					<td>{{$a->id}} </td>
					<td>{{$a->descricao}}</td>
				</tr>
				
					
			@endforeach
		</table>
	</div>
@endif
@stop