@extends('layouts.app')
@section('content')
@if(empty($pendentes))
	<div align="center"><b>Não existem cadastros pendentes!</b></div>
@else

	<div class="container">
		<h1>Cadastros pendentes para Empresas</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>E-mail</b></td>
				<td><b>CNPJ</b></td>
				<td><b>Razão Social</b></td>
				<td><b>Telefone</b></td>
				<td><b>Confirmar Cadastro</b></td>

			</tr> 
			@foreach ($pendentes as $pen)
				<tr>
					<td>{{$pen->email}}</td>
					<td>{{$pen->cnpj}}</td>
					<td>{{$pen->razaosocial}}</td>
					<td>{{$pen->telefone}}</td>
					<td align="left"><a href="/roleuser/confirmacadastro/{{$pen->id_emp}}" ><span class="glyphicon glyphicon-saved"></span></a></td>
				</tr>
			@endforeach
		</table>
	</div>
	
@endif
@stop