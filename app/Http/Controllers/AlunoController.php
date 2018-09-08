<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\Aluno;
	use estagio\Curso;
	use Request;
	use Auth;
	use estagio\Http\Requests\AlunosRequest;

	class AlunoController extends Controller{
		public function __construct(){

		}
		public function novo(){
			$cursos = Curso::all();
			$users = DB::select('select * from users');
			return view('aluno.formulario')->with(array('cursos'=>$cursos,'users'=>$users));
		}

		public function alteraCadastroUser(){
			//$id_curso = 0;
			$id = 0;
			$result = DB::select('select * from alunos where id_user = ?', [Auth::id()]);
			foreach ($result as $res) {
				$id = $res->id;	
			}

			$aluno = Aluno::find($id);
			
			if (empty($aluno)){
				//return "Você não possui nenhum aluno associado!";
				return view('erro.retorno')->with('mensagem', 'Usuário não possui cadastro de aluno associado!');
			}
			$curso = Curso::find($aluno->id_curso);
			return view('aluno.altera')->with(array('a'=>$aluno,'curso'=>$curso));
		}

		public function alteraCadastro($id){
			$aluno = Aluno::find($id);
			$curso = Curso::all();
			if (empty($aluno)){
				return view('erro.retorno')->with('mensagem', 'Aluno não existe!');
			}
			return view('aluno.altera')->with(array('a'=>$aluno,'curso'=>$curso));
		}

		public function adiciona(AlunosRequest $request){
			//aluno::create(Request::all());
			$aluno = new Aluno();
			$aluno->ra = $request->input('ra');
			$aluno->nome = $request->input('nome');
			$aluno->dt_nasc = $request->input('dt_nasc');
			$aluno->ddd = $request->input('ddd');
			$aluno->telefone = $request->input('telefone');
			$aluno->id_curso = $request->input('id_curso');
			$aluno->id_user = $request->input('usuario');
			
			$aluno->save();

			return redirect()
				->action('AlunoController@adicionado')
				->withInput(Request::only('nome'));
		}

		public function adicionado(){
			return view('aluno.adicionado');
		}

		public function atualizado(){
			return view('aluno.atualizado');
		}

		public function confirmaExclusao($id){
			$aluno = Aluno::find($id);
			if(empty($aluno)){
				return ('Aluno inválido!');
			}
			return view('aluno.confirmaexclusao')->with(array('id'=>$aluno->id, 'nome'=>$aluno->nome));
		}

		public function lista(){
			$alunos = DB::select('select a.*, c.descricao from alunos a left join cursos c on a.id_curso = c.id');
			if (empty($alunos)){
				return view('erro.retorno')->with('mensagem', 'Não existem alunos cadastrados!');
			}
			return view('aluno.lista')->with(array('alunos'=>$alunos,'mensagem'=>'Alunos cadastrados'));
		}

		public function remove($id){
			$aluno = Aluno::find($id);
			$aluno->delete();
			return redirect()->action('AlunoController@lista');
		}

		public function atualiza(AlunosRequest $request){
			$aluno = Aluno::find($request->input('id'));
			$aluno->ra = $request->input('ra');
			$aluno->nome = $request->input('nome');
			$aluno->dt_nasc = $request->input('dt_nasc');
			$aluno->ddd = $request->input('ddd');
			$aluno->telefone = $request->input('telefone');
			$aluno->id_curso = $request->input('id_curso');
			$aluno->save();

			return redirect()
				->action('AlunoController@atualizado')
				->withInput(Request::only('nome'));
		}

		public function detalhes($id){
			$aluno = Aluno::find($id);
			if (empty($aluno)){
				return view('erro.retorno')->with('mensagem', 'Perfil não existe!');
			}
			$curso = Curso::find($aluno->id_curso);
			$alunoareas = DB::select('select a.* from areas a inner join aluno_areas va on a.id = va.id_area where va.id_aluno = ?', [$id]);
			$alunocapacidades = DB::select('select c.* from capacidades c inner join aluno_capacidades vc on c.id = vc.id_capacidade where vc.id_aluno = ?', [$id]);
			$alunodiferenciais = DB::select('select d.* from diferenciais d inner join aluno_diferenciais vd on d.id = vd.id_diferencial where vd.id_aluno = ?', [$id]);
			$interesse = 0;
			return view('aluno.detalhes')->with(array('a'=>$aluno,'aa'=>$alunoareas,'ac'=>$alunocapacidades,'ad'=>$alunodiferenciais, 'curso'=>$curso, 'interesse'=>$interesse));


		}

		public function buscaVagas(){
			$id = 0;
			$result = DB::select('select * from alunos where id_user = ?', [Auth::id()]);
			foreach ($result as $res) {
				$id = $res->id;	
			}

			$aluno = Aluno::find($id);
			
			if (empty($aluno)){
				//return "Você não possui nenhum aluno associado!";
				return view('erro.retorno')->with('mensagem', 'Usuário não possui cadastro de aluno associado!');
			}

			$vagas = DB::select('select distinct v.* from vagas v 
				                left join vaga_areas va on v.id = va.id_vaga
				                left join vaga_capacidades vc on v.id = vc.id_vaga
				                left join vaga_diferenciais vd on v.id = vd.id_vaga
				                left join interesse_vagas iv on v.id = iv.id_vaga
				                where (coalesce(iv.id_aluno,0) <> ?) and  ((va.id_area in (select aa.id_area from aluno_areas aa where aa.id_aluno = ?)) or 
				                      (vc.id_capacidade in (select ac.id_capacidade from aluno_capacidades ac where ac.id_aluno = ?)) or 
				                      (vd.id_diferencial in (select ad.id_diferencial from aluno_diferenciais ad where ad.id_aluno = ?))) and 
								(? between v.inioferta and v.fimoferta)', [$aluno->id, $aluno->id, $aluno->id, $aluno->id, date("Y/m/d")]);
			if (empty($vagas)){
				//return "Você não possui nenhum aluno associado!";
				return view('erro.retorno')->with('mensagem', 'Não existem vagas relacionadas ao perfil!');
			}
			return view('vaga.lista')->with(array('vagas'=>$vagas,'mensagem'=>'Vagas Relacionadas ao Perfil'));
		}

		public function buscaInteresses(){
			$id = 0;
			$result = DB::select('select * from alunos where id_user = ?', [Auth::id()]);
			foreach ($result as $res) {
				$id = $res->id;	
			}

			$aluno = Aluno::find($id);
			
			if (empty($aluno)){
				//return "Você não possui nenhum aluno associado!";
				return view('erro.retorno')->with('mensagem', 'Usuário não possui cadastro de aluno associado!');
			}

			$vagas = DB::select('select v.* from vagas v 
				                 inner join interesse_vagas iv on v.id = iv.id_vaga
				                 where iv.id_aluno = ? and coalesce(iv.efetivado,0) <> 1', [$aluno->id]);
			if (empty($vagas)){
				//return "Você não possui nenhum aluno associado!";
				return view('erro.retorno')->with('mensagem', 'Não existem interesses pendentes!');
			}			
			return view('vaga.lista')->with(array('vagas'=>$vagas, 'mensagem'=>'Meus interesses'));

		}




	}
