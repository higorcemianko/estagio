<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function()
{
	//requer teste
	Route::get('/empresas/nova', 'EmpresaController@nova');
	Route::post('/empresas/adiciona', 'EmpresaController@adiciona');
	Route::get('/empresas/adicionada', 'EmpresaController@adicionada');
	//empresa
	Route::group(['middleware' => ['role:Empresa']], function(){	
		Route::get('/empresas/alterauser', 'EmpresaController@alteraCadastroUser');
		Route::get('/empresas/efetivaestagio/{id}', 'EmpresaController@efetivaEstagio')->where('id', '[0-9]+');
		Route::get('/empresas/gravaestagio/{id}', 'EmpresaController@gravaEstagio')->where('id', '[0-9]+');
		//vagas
		Route::get('/vagas/nova', 'VagaController@nova');
		Route::post('/vagas/adiciona', 'VagaController@adiciona');
		Route::get('/vagas/remove', 'VagaController@remove');
		Route::get('/vagas/adicionada', 'VagaController@adicionada');	
		Route::get('/vagas/buscaalunos/{id}', 'VagaController@buscaAlunos')->where('id', '[0-9]+');

		
		//Area
		Route::get('/vagaarea/nova/{id}', 'VagaAreaController@nova')->where('id', '[0-9]+');
		Route::get('/vagaarea/lista/{id}', 'VagaAreaController@lista')->where('id', '[0-9]+');
		Route::post('/vagaarea/adiciona/{id}', 'VagaAreaController@adiciona')->where('id', '[0-9]+');
		Route::get('/vagaarea/confexcl/{id}', 'VagaAreaController@confirmaExclusao')->where('id', '[0-9]+');
		Route::get('/vagaarea/remove/{id}', 'VagaAreaController@remove')->where('id', '[0-9]+');
		//Diferencial
		Route::get('/vagadiferencial/nova/{id}', 'VagaDiferencialController@nova')->where('id', '[0-9]+');
		Route::get('/vagadiferencial/lista/{id}', 'VagaDiferencialController@lista')->where('id', '[0-9]+');
		Route::post('/vagadiferencial/adiciona/{id}', 'VagaDiferencialController@adiciona')->where('id', '[0-9]+');
		Route::get('/vagadiferencial/confexcl/{id}', 'VagaDiferencialController@confirmaExclusao')->where('id', '[0-9]+');
		Route::get('/vagadiferencial/remove/{id}', 'VagaDiferencialController@remove')->where('id', '[0-9]+');

		//Capacidade
		Route::get('/vagacapacidade/nova/{id}', 'VagaCapacidadeController@nova')->where('id', '[0-9]+');
		Route::get('/vagacapacidade/lista/{id}', 'VagaCapacidadeController@lista')->where('id', '[0-9]+');
		Route::post('/vagacapacidade/adiciona/{id}', 'VagaCapacidadeController@adiciona')->where('id', '[0-9]+');
		Route::get('/vagacapacidade/confexcl/{id}', 'VagaCapacidadeController@confirmaExclusao')->where('id', '[0-9]+');
		Route::get('/vagacapacidade/remove/{id}', 'VagaCapacidadeController@remove')->where('id', '[0-9]+');
	});
	//aluno
	Route::group(['middleware' => ['role:Aluno']], function(){	
		Route::get('/aluno/alterauser', 'AlunoController@alteraCadastroUser');
		
		Route::get('/alunos/buscavagas', 'AlunoController@buscaVagas');
		//Area
		Route::get('/alunoarea/nova/{id}', 'AlunoAreaController@nova')->where('id', '[0-9]+');
		Route::get('/alunoarea/lista', 'AlunoAreaController@lista');
		Route::post('/alunoarea/adiciona/{id}', 'AlunoAreaController@adiciona')->where('id', '[0-9]+');
		Route::get('/alunoarea/confexcl/{id}', 'AlunoAreaController@confirmaExclusao')->where('id', '[0-9]+');
		Route::get('/alunoarea/remove/{id}', 'AlunoAreaController@remove')->where('id', '[0-9]+');

		//Capacidade
		Route::get('/alunocapacidade/nova/{id}', 'AlunoCapacidadeController@nova')->where('id', '[0-9]+');
		Route::get('/alunocapacidade/lista', 'AlunoCapacidadeController@lista');
		Route::post('/alunocapacidade/adiciona/{id}', 'AlunoCapacidadeController@adiciona')->where('id', '[0-9]+');
		Route::get('/alunocapacidade/confexcl/{id}', 'AlunoCapacidadeController@confirmaExclusao')->where('id', '[0-9]+');
		Route::get('/alunocapacidade/remove/{id}', 'AlunoCapacidadeController@remove')->where('id', '[0-9]+');

		//Area
		Route::get('/alunodiferencial/nova/{id}', 'AlunoDiferencialController@nova')->where('id', '[0-9]+');
		Route::get('/alunodiferencial/lista', 'AlunoDiferencialController@lista');
		Route::post('/alunodiferencial/adiciona/{id}', 'AlunoDiferencialController@adiciona')->where('id', '[0-9]+');
		Route::get('/alunodiferencial/confexcl/{id}', 'AlunoDiferencialController@confirmaExclusao')->where('id', '[0-9]+');
		Route::get('/alunodiferencial/remove/{id}', 'AlunoDiferencialController@remove')->where('id', '[0-9]+');
		Route::get('/vagas/confirmainteresse/{id}', 'VagaController@confirmaInteresse')->where('id', '[0-9]+');
		Route::get('/vagas/registrainteresse/{id}', 'VagaController@registraInteresse')->where('id', '[0-9]+');
		Route::get('/aluno/buscainteresses', 'AlunoController@buscaInteresses');

	});
	

	Route::group(['middleware' => ['role:Admin']], function(){
		//curso
		Route::get('/cursos/adicionado', 'CursoController@adicionado');
		Route::post('/cursos/adiciona', 'CursoController@adiciona');
		Route::get('/cursos/lista', 'CursoController@lista');
		Route::get('/cursos/novo', 'CursoController@novo');

		//empresas
		
		Route::get('/empresas/altera/{id}', 'EmpresaController@alteraCadastro')->where('id', '[0-9]+');
		
		
		Route::get('/empresas/confexcl/{id}', 'EmpresaController@confirmaExclusao')->where('id', '[0-9]+');
		Route::get('/empresas/remove/{id}', 'EmpresaController@remove')->where('id', '[0-9]+');
		Route::get('/empresas/lista', 'EmpresaController@lista');
		Route::get('/empresas/estagiosefetivados', 'EmpresasController@estagiosEfetivados');


		//aluno
		Route::get('/alunos/nova', 'AlunoController@novo');
		Route::get('/alunos/altera/{id}', 'AlunoController@alteraCadastro')->where('id', '[0-9]+');
		Route::post('/alunos/adiciona', 'AlunoController@adiciona');
		Route::get('/alunos/adicionado', 'AlunoController@adicionado');
		Route::get('/alunos/confexcl/{id}', 'AlunoController@confirmaExclusao')->where('id', '[0-9]+');
		Route::get('/alunos/remove/{id}', 'AlunoController@remove')->where('id', '[0-9]+');
		

		//papel usuario
		Route::get('/roleuser/novo', 'RoleUserController@novo');
		Route::post('/roleuser/adiciona', 'RoleUserController@adiciona');
		Route::get('/roleuser/adicionado', 'RoleUserController@adicionado');
		Route::get('/roleuser/empresaspendentes', 'RoleUserController@empresasPendentes');
		Route::get('/roleuser/confirmacadastro/{id_emp}', 'RoleUserController@confirmaCadastro');
		Route::get('/roleuser/aceitacadastro/{id}', 'RoleUserController@aceitaCadastro');


		//area
		Route::get('/areas/adicionada', 'AreaController@adicionada');
		Route::post('/areas/adiciona', 'AreaController@adiciona');
		Route::get('/areas/lista', 'AreaController@lista');
		Route::get('/areas/nova', 'AreaController@nova');

		//capacidade
		Route::get('/capacidades/adicionada', 'CapacidadeController@adicionada');
		Route::post('/capacidades/adiciona', 'CapacidadeController@adiciona');
		Route::get('/capacidades/lista', 'CapacidadeController@lista');
		Route::get('/capacidades/nova', 'CapacidadeController@nova');

		//diferencial
		Route::get('/diferenciais/adicionado', 'DiferencialController@adicionado');
		Route::post('/diferenciais/adiciona', 'DiferencialController@adiciona');
		Route::get('/diferenciais/lista', 'DiferencialController@lista');
		Route::get('/diferenciais/novo', 'DiferencialController@novo');

		Route::get('/empresas/estagiosefetivados', 'EmpresaController@estagiosEfetivados');
		Route::get('/vagas/listaadmin', 'VagaController@listaAdmin');
		Route::post('importExcel', 'ExcelController@importaUsers');
		Route::get('/carregaarquivo', 'ExcelController@carregaArquivo');


	});
	
	Route::group(['middleware' => ['role:Admin|Aluno']], function(){
		Route::post('/alunos/atualiza', 'AlunoController@atualiza');	
		Route::get('/alunos/atualizado', 'AlunoController@atualizado');
	});

	Route::group(['middleware' => ['role:Admin|Empresa']], function(){
		Route::post('/empresas/atualiza', 'EmpresaController@atualiza');	
		Route::get('/empresas/atualizada', 'EmpresaController@atualizada');
		Route::get('/alunos/lista', 'AlunoController@lista');
		Route::get('/vagas/altera/{id}', 'VagaController@altera');
		Route::post('/vagas/atualiza', 'VagaController@atualiza');
		Route::get('/vagas/atualizada', 'VagaController@atualizada');
		Route::get('/vagas/consultainteresses/{id}', 'VagaController@consultaInteresse')->where('id', '[0-9]+');
		Route::get('/vagas/consultaefetivados/{id}', 'VagaController@consultaEfetivados')->where('id', '[0-9]+');
	});

	Route::group(['middleware' => ['role:Aluno|Empresa']], function(){
		Route::get('/vagas/lista', 'VagaController@lista');
		Route::get('/aluno/detalhes/{id}', 'AlunoController@detalhes')->where('id', '[0-9]+');
	});

	Route::group(['middleware' => ['role:Aluno|Empresa|Admin']], function(){
		Route::get('/vagas/detalhes/{id}', 'VagaController@detalhes')->where('id', '[0-9]+');
	});	
		

});