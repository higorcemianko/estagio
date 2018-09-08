@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Detalhes da vaga: {{$v->titulo}} </h1>
	<table class="table table-striped table-bordered table-hover" style="width:100%" >
		<tr style="background-color:#B0C4DE">
			<th><b>Dados gerais</b></th>
		</tr>
		<tr>
			<th>
				<li>
					<b>Empresa:</b> {{$e->razaosocial}}
				</li>
				<li>
					<b>Descrição:</b> {{$v->descricao}}
				</li>
				<li>
					<b>Período:</b> {{$v->periodo}}
				</li>
				<li>
					<b>Início:</b> {{$v->inicio}}
				</li>
				<li>
					<b>Fim:</b> {{$v->fim}}
				</li>
				<li>
					<b>Salário:</b> {{$v->salario}}
				</li>
				@if ($e->autorizacontato == 1)
					<li>
						<b>Contato: {{$e->ddd}} - {{$e->telefone}}</b> 
					</li>
				@endif
			</th>	
		</tr>
		<tr style="background-color:#B0C4DE">
			<th><b>Áreas</b></th>
		</tr>
		<tr>
			<th>
				@foreach ($va as $vagaarea)
					<li>
						{{$vagaarea->descricao}}
					</li>	
				@endforeach
			</th>
		</tr>
		<tr style="background-color:#B0C4DE">
			<th><b>Capacidades</b></th>
		</tr>
		<tr>
			<th>
				@foreach ($vc as $vagacapacidade)
					<li>
						{{$vagacapacidade->descricao}}
					</li>	
				@endforeach
			</th>
		</tr>
		<tr style="background-color:#B0C4DE">
			<th><b>Diferenciais</b></th>
		</tr>
		<tr>
			<th>
				@foreach ($vd as $vagadiferencial)
					<li>
						{{$vagadiferencial->descricao}}
					</li>	
				@endforeach
			</th>
		</tr>
		@role('Empresa')
			<tr>
				<th>
					<a href="/vagas/buscaalunos/{{$v->id}}" class="btn btn-primary">Encontrar alunos <span class="glyphicon glyphicon-eye-open"></span></a>
					<a href="/vagas/consultainteresses/{{$v->id}}" class="btn btn-primary">Alunos interessados <span class="glyphicon glyphicon-flag"></span></a>
					<a href="/vagas/consultaefetivados/{{$v->id}}" class="btn btn-primary">Alunos efetivados <span class="glyphicon glyphicon-lock"></span></a>
				</th>
		
			</tr>
			
		@endrole
		@role('Aluno')
			<tr>
			<th>
				<a href="/vagas/confirmainteresse/{{$v->id}}" class="btn btn-primary">Demonstrar Interesse <span class="glyphicon glyphicon-eye-open"></span></a>
			</th>
			</tr>
			
		@endrole
	</table>
	
</div>
@stop