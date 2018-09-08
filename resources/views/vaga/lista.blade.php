@extends('layouts.app')
@section('content')
@if(empty($vagas))
	<div>Não existem vagas cadastradas</div>
@else

	<div class="container">
		<h1>{{$mensagem}}</h1>
		<table class="table table-striped table-bordered table-hover">
			<tr style="background-color:#B0C4DE">
				<td><b>Título</b></td>
				<td><b>Descrição</b></td>
				<td><b>Período</b></td>
				<td><b>Início</b></td>
				<td><b>Fim</b></td>
				<td><b>Salário</b></td>
				@role('Empresa')
					<td><b>Dados Gerais</b></td>
					<td><b>Áreas</b></td>
					<td><b>Capacidades</b></td>
					<td><b>Diferenciais</b></td>
				@endrole
				@role('Admin')
					<td><b>Dados Gerais</b></td>
				@endrole
				<td><b>Detalhes</b></td>
			</tr> 
			@foreach ($vagas as $v)
				<tr>
					<td>{{$v->titulo}}</td>
					<td>{{$v->descricao}}</td>
					@if ($v->periodo == "matutino")
						<td>Matutino</td>
					@else
						@if ($v->periodo == "vespertino")
							<td>Vespertino</td>
						@else
							@if ($v->periodo == "integral")
								<td>Integral</td>
							@else
								@if ($v->periodo == "noturno")
									<td>Noturno</td>
								@else
									<td>Diurno</td>
								@endif
							@endif
						@endif						
					@endif
					<td>{{$v->inicio}}</td>
					<td>{{$v->fim}}</td>
					<td>{{$v->salario}}</td>
					@role('Empresa')
						<td align="center"><a href="/vagas/altera/{{$v->id}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
						<td align="center"><a href="/vagaarea/lista/{{$v->id}}"><span class="glyphicon glyphicon-zoom-in"></span></a></td>
						<td align="center"><a href="/vagacapacidade/lista/{{$v->id}}"><span class="glyphicon glyphicon-zoom-in"></span></a></td>
						<td align="center"><a href="/vagadiferencial/lista/{{$v->id}}"><span class="glyphicon glyphicon-zoom-in"></span></a></td>
					@endrole
					@role('Admin')
						<td align="center"><a href="/vagas/altera/{{$v->id}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
					@endrole
					<td align="center"><a href="/vagas/detalhes/{{$v->id}}" ><span class="glyphicon glyphicon-search"></span></a></td>
				</tr>
			@endforeach
		</table>
	</div>
	
@endif
@stop