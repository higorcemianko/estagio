@extends('layouts.app')
@section('content')
@if(empty($empresas))
	<div>Não existem empresas cadastradas</div>
@else

	<div class="container">
		<h1>Empresas cadastradas</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>CNPJ</b></td>
				<td><b>Razão Social</b></td>
				<td><b>Telefone</b></td>
				<td><b>Cidade</b></td>
				<td><b>UF</b></td>
				<td><b>Editar</b></td>
				<td><b>Remover</b></td>
			</tr>	
			@foreach ($empresas as $e) 
				<tr>
					<td>{{$e->cnpj}} </td>
					<td>{{$e->razaosocial}}</td>
					<td>{{$e->ddd}} - {{$e->telefone}}</td>
					<td>{{$e->nome}}</td>
					<td>{{$e->uf}}</td>
					<td><a href="/empresas/altera/{{$e->id}}"><span class="glyphicon glyphicon-search"></span></a></td>
					<td><a href="/empresas/confexcl/{{$e->id}}"><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
			@endforeach
		</table>
	</div>
	@if(old('razaosocial'))
		<div class="alert alert-success">
			<strong>Sucesso!</strong> A empresa {{ old('razaosocial') }} foi cadastrada.
		</div>
	@endif
@endif
@stop