@extends('layouts.app')
@section('content')
<div  class="container">
	<div >
		<h1>Nova empresa</h1>
	</div>
	
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="/empresas/adiciona" method="post" name="frmEmpresa" onsubmit="return validarEmpresa(document.frmEmpresa.cnpj.value, document.frmEmpresa.razaosocial.value, document.frmEmpresa.cidade.value)">
				
		<input type="hidden"
			name="_token" value="{{{ csrf_token() }}}" />
		<div class="form-group">
			<label>CNPJ</label><br>
			<input name="cnpj"> 
		</div>
		<div class="form-group">
			<label>Razão Social</label><br>
			<input name="razaosocial" size="150"> 
		</div>
		<div class="form-group">
			<label>Telefone</label><br>
			<input name="ddd" size="2" type="integer"><input name="telefone" size="integer">
		</div>
		<div class="form-group">
			<label>UF</label><br>
			<select id="uf" name="uf">
				<option value="ac">AC</option>
				<option value="al">AL</option>
				<option value="ap">AP</option>
				<option value="am">AM</option>
				<option value="ba">BA</option>
				<option value="ce">CE</option>
				<option value="df">DF</option>
				<option value="es">ES</option>
				<option value="go">GO</option>
				<option value="ma">MA</option>
				<option value="mt">MT</option>
				<option value="ms">MS</option>
				<option value="mg">MG</option>
				<option value="pa">PA</option>
				<option value="pb">PB</option>
				<option value="pr">PR</option>
				<option value="pe">PE</option>
				<option value="pi">PI</option>
				<option value="rj">RJ</option>
				<option value="rn">RN</option>
				<option value="rs">RS</option>
				<option value="ro">RO</option>
				<option value="rr">RR</option>
				<option value="sc">SC</option>
				<option value="sp">SP</option>
				<option value="se">SE</option>
				<option value="to">TO</option>
			</select>
		</div>
		<div class="form-group">
			<label>Cidade</label><br>
			<select id="cidade" name="cidade" >
				@foreach ($cidades as $c)
					<option value="{{$c->id}}">{{$c->nome}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<input type="checkbox" id="autorizacontato" value="1"> Autoriza contato dos candidatos por telefone
		</div>
		@role('Admin')
			<div class="form-group">
				<label>Usuário</label><br>
				<select name="usuario">
					@foreach ($users as $u)
						<option value="{{$u->id}}">{{$u->name}}</option>
					@endforeach
				</select>
			</div>
		@else
			<div class="form-group">
				<label>Usuário</label><br>
				<select name="usuario">
					@foreach ($users as $u)
						@if(Auth::id() == $u->id)						
							<option value="{{$u->id}}" selected="selected">{{$u->name}}</option>
						@endif
					@endforeach
				</select>
			</div>
		@endrole
		<div class="form-group">
			<span style="color:red" id="error"> </span>
		</div>

		<div class="form-group">
			<button type="submit" class="btn
			btn-primary ">OK</button>
		</div>
		
	</form>
</div>


@stop