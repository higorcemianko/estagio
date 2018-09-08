@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @role('Admin')
                    <div class="panel-heading" style="background-color: #00BFFF"><b>Painel Administrador</b></div>
                @endrole
                @role('Aluno')
                    <div class="panel-heading" style="background-color: #00BFFF"><b>Painel Aluno</b></div>
                @endrole
                @role('Empresa')
                    <div class="panel-heading" style="background-color: #00BFFF"><b>Painel Empresa</b></div>
                @endrole

                <div class="panel-body">
                    Bem-vindo ao Sistema de Gerenciamento de Estágio - UNESP!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
