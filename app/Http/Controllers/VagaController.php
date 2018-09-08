<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\Vaga;
	use estagio\VagaArea;
	use estagio\VagaCapacidade;
	use estagio\VagaDiferecial;
	use estagio\Empresa;
	use Auth;
	use estagio\InteresseVaga;
	use Request;
	use estagio\Http\Requests\VagasRequest;

	class VagaController extends Controller{
	  	public function nova(){
			return view('vaga.formulario');
		}

		public function detalhes($id){
			$id_emp = 0;
			$vaga = Vaga::find($id);
			$empresas = DB::select('select e.id, e.ddd, e.telefone, e.autorizacontato from empresas e where e.id_user = ?', [$vaga->id_user]);
			foreach ($empresas as $emp) {
				$id_emp = $emp->id;	
			}
			if (empty($empresa)){
				//return "Esta vaga não existe!";
				return view('erro.retorno')->with('mensagem', 'Empresa sem usuário associado!');
			}

			$empresa = Empresa::find($id_emp);

			if (empty($vaga)){
				//return "Esta vaga não existe!";
				return view('erro.retorno')->with('mensagem', 'Vaga não existe!');
			}
			$vagaareas = DB::select('select a.* from areas a inner join vaga_areas va on a.id = va.id_area where va.id_vaga = ?', [$id]);
			$vagacapacidades = DB::select('select c.* from capacidades c inner join vaga_capacidades vc on c.id = vc.id_capacidade where vc.id_vaga = ?', [$id]);
			$vagadiferenciais = DB::select('select d.* from diferenciais d inner join vaga_diferenciais vd on d.id = vd.id_diferencial where vd.id_vaga = ?', [$id]);
			return view('vaga.detalhes')->with(array('v'=>$vaga,'va'=>$vagaareas,'vc'=>$vagacapacidades,'vd'=>$vagadiferenciais, 'e'=>$empresa));
		}

		public function altera($id){
			$vaga = Vaga::find($id);
			if (empty($vaga)){
				//return "Esta vaga não existe!";
				return view('erro.retorno')->with('mensagem', 'Vaga não existe!');
			}
			/*$vagaareas = DB::select('select a.* from areas a inner join vaga_areas va on a.id = va.id_area where va.id_vaga = ?', [$id]);
			$vagacapacidades = DB::select('select c.* from capacidades c inner join vaga_capacidades vc on c.id = vc.id_capacidade where vc.id_vaga = ?', [$id]);
			$vagadiferenciais = DB::select('select d.* from diferenciais d inner join vaga_diferenciais vd on d.id = vd.id_diferencial where vd.id_vaga = ?', [$id]);*/
			return view('vaga.altera')->with('v',$vaga);
		}

		public function atualizada(){
			return view('vaga.atualizada');
		}

		public function adiciona(VagasRequest $request){
			//Vaga::create($request->all());
			$vaga = new Vaga();
			$vaga->titulo = $request->input('titulo');
			$vaga->descricao = $request->input('descricao');
			$vaga->inicio = $request->input('inicio');
			$vaga->fim = $request->input('fim');
			$vaga->inioferta = $request->input('inioferta');
			$vaga->fimoferta = $request->input('fimoferta');
			$vaga->salario = $request->input('salario');
			$vaga->periodo = $request->input('periodo');
			$vaga->id_user = Auth::id();
			$vaga->save();

			return redirect()
				->action('VagaController@adicionada')
				->withInput(Request::only('titulo'));
		}

		public function atualiza(VagasRequest $request){
			$vaga = Vaga::find($request->input('id'));

			$vaga->titulo = $request->input('titulo');
			$vaga->descricao = $request->input('descricao');
			$vaga->inicio = $request->input('inicio');
			$vaga->fim = $request->input('fim');
			$vaga->inioferta = $request->input('inioferta');
			$vaga->fimoferta = $request->input('fimoferta');
			$vaga->salario = $request->input('salario');
			$vaga->periodo = $request->input('periodo');
			$vaga->save();

			return redirect()
				->action('VagaController@atualizada')
				->withInput(Request::only('titulo'));	
		}

		public function adicionada(){
			return view('vaga.adicionada');
		}

		public function remove(){
			$vaga = Vaga::find($id);
			$vaga->delete();
			return redirect()->action('VagaController@lista');	
		}

		public function lista(){
			$vagas = DB::select('select v.*, e.ddd, e.telefone, e.autorizacontato from vagas v 
				                 left join empresas e on v.id_user = e.id_user 
				                 where v.id_user = ? and ? between v.inioferta and v.fimoferta', [Auth::id(), date("Y/m/d")]);
			if (empty($vagas)){
				return view('erro.retorno')->with('mensagem', 'Não existem vagas cadastradas!');
			}
			return view('vaga.lista')->with(array('vagas'=>$vagas,'mensagem'=>'Vagas Cadastradas'));
		}

		public function listaAdmin(){
			$vagas = DB::select('select v.*, e.ddd, e.telefone, e.autorizacontato from vagas v
								 left join empresas e on v.id_user = e.id_user  
				                 where ? between v.inioferta and v.fimoferta', [date("Y/m/d")]);
			if (empty($vagas)){
				return view('erro.retorno')->with('mensagem', 'Não existem vagas cadastradas!');
			}
			return view('vaga.lista')->with(array('vagas'=>$vagas,'mensagem'=>'Vagas Cadastradas'));
		}

		public function buscaAlunos($id){
			$vaga = Vaga::find($id);
			if ($vaga->id_user != Auth::id()){
				return view('erro.retorno')->with('mensagem', 'Vaga não pertence ao usuário ativo!');
			}
			
			$alunos = DB::select('select distinct a.*, c.descricao from alunos a
								left join cursos c on a.id_curso = c.id 
				                left join aluno_areas aa on a.id = aa.id_aluno
				                left join aluno_capacidades ac on a.id = ac.id_aluno
				                left join aluno_diferenciais ad on a.id = ad.id_aluno
				                left join interesse_vagas iv on a.id = iv.id_aluno
				                where (coalesce(iv.id_vaga,0) <> ?) and ((aa.id_area in (select va.id_area from vaga_areas va where va.id_vaga = ?)) or 
				                      (ac.id_capacidade in (select vc.id_capacidade from vaga_capacidades vc where vc.id_vaga = ?)) or 
				                      (ad.id_diferencial in (select vd.id_diferencial from vaga_diferenciais vd where vd.id_vaga = ?)))', [$id, $id, $id, $id]);
			return view('aluno.lista')->with(array('alunos'=>$alunos,'mensagem'=>'Alunos relacionados'));
		}

		public function confirmaInteresse($id){
			$vaga = Vaga::find($id);
			if(empty($vaga)){
				return view('erro.retorno')->with('mensagem', 'Vaga não cadastrada!');
			}
			return view('vaga.confirmainteresse')->with('vaga', $vaga);
		}

		public function registraInteresse($id){
			$vaga = Vaga::find($id);
			if(empty($vaga)){
				return view('erro.retorno')->with('mensagem', 'Vaga não cadastrada!');
			}
			$id_aluno = 0;
			$result = DB::select('select * from alunos where id_user = ?', [Auth::id()]);
			foreach ($result as $res) {
				$id_aluno = $res->id;	
			}
			$interessevaga = new InteresseVaga();
			$interessevaga->id_vaga = $vaga->id;
			$interessevaga->id_aluno = $id_aluno;
			$interessevaga->efetivado = 0;
			$interessevaga->save();

			return view('vaga.interesseregistrado')->with('titulo',$vaga->titulo);
		}

		public function consultaInteresse($id){
			$vaga = Vaga::find($id);
			if ($vaga->id_user != Auth::id()){
				return view('erro.retorno')->with('mensagem', 'Vaga não pertence ao usuário ativo!');
			}

			$result = DB::select('select a.*, iv.id as id_interesse from interesse_vagas iv left join alunos a on iv.id_aluno = a.id where coalesce(iv.efetivado,0) = 0 and iv.id_vaga = ?', [$id]);

			return view('vaga.listainteresse')->with(array('interesses'=>$result, 'mensagem'=>'Alunos Interessados', 'efetivado'=>0));
		}

		public function consultaEfetivados($id){
			$vaga = Vaga::find($id);
			if ($vaga->id_user != Auth::id()){
				return view('erro.retorno')->with('mensagem', 'Vaga não pertence ao usuário ativo!');
			}

			$result = DB::select('select a.*, iv.id as id_interesse from interesse_vagas iv left join alunos a on iv.id_aluno = a.id where coalesce(iv.efetivado,0) = 1 and iv.id_vaga = ?', [$id]);

			return view('vaga.listainteresse')->with(array('interesses'=>$result, 'mensagem'=>'Alunos Efetivados', 'efetivado'=>1));
		}

		



	}