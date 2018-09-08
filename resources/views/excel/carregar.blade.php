@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Importar Alunos</h1>
	<form  action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data" >

		<input type="file" name="import_file">
		{{ csrf_field() }}
		<br/>

		<button class="btn btn-primary">Importar</button>

	</form>
</div>
@stop