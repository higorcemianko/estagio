@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Confirmação de Cadastro</h1>
	<table class="table table-striped table-bordered table-hover" style="width:100%" >
		<tr style="background-color:#B0C4DE">
			<th><b>Empresa</b></th>
		</tr>
		<tr>
			<th>
				<li>
					<b>Usuário:</b> {{$user->email}}
				</li>
				<li>
					<b>CNPJ:</b> {{$empresa->cnpj}}
				</li>
				<li>
					<b>Razão Social:</b> {{$empresa->razaosocial}}
				</li>
				<li>
					<b>Telefone:</b> {{$empresa->ddd}} - {{$empresa->telefone}}
				</li>
			</th>	
		</tr>
		<tr>
			<th>
				<a href="/roleuser/aceitacadastro/{{$user->id}}" class="btn btn-primary">Confirmar <span class="glyphicon glyphicon-saved"></span></a>				
			</th>
	
		</tr>
		
	</table>
	
</div>
@stop