@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Confirmação de Efetivação de Estágio</h1>
	<table class="table table-striped table-bordered table-hover" style="width:100%" >
		<tr style="background-color:#B0C4DE">
			<th><b>Dados gerais</b></th>
		</tr>
		<tr>
			<th>
				<li>
					<b>Título:</b> {{$vaga->titulo}}
				</li>
				<li>
					<b>Descrição:</b> {{$vaga->descricao}}
				</li>
				<li>
					<b>Período:</b> {{$vaga->periodo}}
				</li>
				<li>
					<b>Início:</b> {{$vaga->inicio}}
				</li>
				<li>
					<b>Fim:</b> {{$vaga->fim}}
				</li>
				<li>
					<b>Salário:</b> {{$vaga->salario}}
				</li>
			</th>	
		</tr>
		<tr style="background-color:#B0C4DE">
			<th><b>Dados do Aluno</b></th>
		</tr>
		<tr>
			<th>
				<li>
					<b>RA: </b> {{$aluno->ra}}
				</li>
				<li>
					<b>Nome: </b> {{$aluno->nome}}
				</li>
				<li>
					<b>Data de Nascimento: </b> {{$aluno->dt_nasc}}
				</li>
				<li>
					<b>Curso: </b> {{$curso->descricao}}
				</li>
			</th>
		</tr>
		
		@role('Empresa')
			<tr>
				<th>
					<a href="/empresas/gravaestagio/{{$interessevaga->id}}" class="btn btn-primary">Confirmar <span class="glyphicon glyphicon-saved"></span></a>				
				</th>
		
			</tr>
			
		@endrole
		
	</table>
	
</div>
@stop