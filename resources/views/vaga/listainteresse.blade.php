@extends('layouts.app')
@section('content')
@if(empty($interesses))
	<div align="center"><b>Não existem interesses!</b></div>
@else

	<div class="container">
		<h1>{{$mensagem}}</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>RA</b></td>
				<td><b>Nome</b></td>
				<td><b>Data de Nascimento</b></td>
				<td><b>Perfil</b></td>
				@if($efetivado != 1)
					<td><b>Efetivar Estágio</b></td>
				@endif

			</tr> 
			@foreach ($interesses as $int)
				<tr>
					<td>{{$int->ra}}</td>
					<td>{{$int->nome}}</td>
					<td>{{$int->dt_nasc}}</td>
					<td align="left"><a href="/aluno/detalhes/{{$int->id}}" ><span class="glyphicon glyphicon-search"></span></a></td>
					@if($efetivado != 1)
						<td align="left"><a href="/empresas/efetivaestagio/{{$int->id_interesse}}" ><span class="glyphicon glyphicon-saved"></span></a></td>
					@endif
				</tr>
			@endforeach
		</table>
	</div>
	
@endif
@stop