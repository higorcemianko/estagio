@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Detalhes do perfil: {{$a->nome}} </h1>
	<table class="table table-striped table-bordered table-hover" style="width:100%" >
		<tr style="background-color:#B0C4DE">
			<th><b>Dados gerais</b></th>
		</tr>
		<tr>
			<th>
				<li>
					<b>RA: </b> {{$a->ra}}
				</li>
				<li>
					<b>Nome: </b> {{$a->nome}}
				</li>
				<li>
					<b>Data de Nascimento: </b> {{$a->dt_nasc}}
				</li>
				<li>
					<b>Curso: </b> {{$curso->descricao}}
				</li>
			</th>	
		</tr>
		<tr style="background-color:#B0C4DE">
			<th><b>Áreas</b></th>
		</tr>
		<tr>
			<th>
				@foreach ($aa as $alunoarea)
					<li>
						{{$alunoarea->descricao}}
					</li>	
				@endforeach
			</th>
		</tr>
		<tr style="background-color:#B0C4DE">
			<th><b>Capacidades</b></th>
		</tr>
		<tr>
			<th>
				@foreach ($ac as $alunocapacidade)
					<li>
						{{$alunocapacidade->descricao}}
					</li>	
				@endforeach
			</th>
		</tr>
		<tr style="background-color:#B0C4DE">
			<th><b>Diferenciais</b></th>
		</tr>
		<tr>
			<th>
				@foreach ($ad as $alunodiferencial)
					<li>
						{{$alunodiferencial->descricao}}
					</li>	
				@endforeach
			</th>
		</tr>
		
	</table>
	
	
</div>
@stop