<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Mail;
	use estagio\Empresa;
	use estagio\Cidade;
	use estagio\InteresseVaga;
	use estagio\EstagioEfetivado;
	use estagio\Vaga;
	use estagio\Aluno;
	use estagio\Curso;
	use estagio\User;
	use Request;
	use Auth;
	use estagio\Http\Requests\EmpresasRequest;
	use estagio\Mail\NovoUsuario;	
	class EmpresaController extends Controller{
		public function __construct(){

		}
		public function nova(){
			if (Auth::user()->hasRole('Aluno')){
				return view('erro.retorno')->with('mensagem', 'Usuário já possui cadastro!');	
			}
			
			$users = DB::select('select * from users');
			$cidades = Cidade::all();
			return view('empresa.formulario')->with(array('users'=>$users,'cidades'=>$cidades));
		}

		public function alteraCadastroUser(){
			$id = 0;
			$result = DB::select('select * from empresas where id_user = ?', [Auth::id()]);
			foreach ($result as $res) {
				$id = $res->id;
			}

			$empresa = Empresa::find($id);
			if (empty($empresa)){
				//return "Você não possui nenhuma empresa associada!";
				return view('erro.retorno')->with('mensagem', 'Usuário não possui cadastro de empresa associado!');
			}
			$cidades = Cidade::all();
			return view('empresa.altera')->with(array('e'=>$empresa,'cidades'=>$cidades));
		}

		public function alteraCadastro($id){
			$empresa = Empresa::find($id);

			if (empty($empresa)){
				//return "Esta empresa não existe!";
				return view('erro.retorno')->with('mensagem', 'Empresa não existe!');
			}
			$cidades = Cidade::all();
			return view('empresa.altera')->with(array('e'=>$empresa,'cidades'=>$cidades));
		}

		public function adiciona(EmpresasRequest $request){
			//Empresa::create(Request::all());
			if (Auth::user()->hasRole('Aluno')){
				return view('erro.retorno')->with('mensagem', 'Usuário já possui cadastro');	
			}

			$empresa = new Empresa();
			//$empresa->cnpj = Request::input('cnpj');
			$empresa->cnpj = $request->input('cnpj');
			$empresa->razaosocial = $request->input('razaosocial');
			$empresa->ddd = $request->input('ddd');
			$empresa->telefone = $request->input('telefone');
			$empresa->id_cidade = $request->input('cidade');
			$empresa->id_user = $request->input('usuario');
			$empresa->autorizacontato = $request->input('autorizacontato');

			$empresa->save();

			

			return redirect()
				->action('EmpresaController@adicionada')
				->withInput(Request::only('razaosocial'));
			
		}

		public function adicionada(){
			if (Auth::user()->hasRole('Aluno')){
				return view('erro.retorno')->with('mensagem', 'Usuário já possui cadastro!');	
			}
			return view('empresa.adicionada');
		}

		public function atualizada(){
			return view('empresa.atualizada');
		}

		public function confirmaExclusao($id){
			$empresa = Empresa::find($id);
			if(empty($empresa)){
				return ('Empresa inválido!');
			}
			return view('empresa.confirmaexclusao')->with(array('id'=>$empresa->id, 'razaosocial'=>$empresa->razaosocial));
		}

		public function lista(){
			$empresas = DB::select('select e.*, c.nome, c.uf from empresas e left join cidades c on e.id_cidade = c.id');
			if (empty($empresas)){
				return view('erro.retorno')->with('mensagem', 'Não existem empresas cadastradas!');
			}
			return view('empresa.lista')->with('empresas', $empresas);
		}

		public function remove($id){
			$empresa = Empresa::find($id);
			$empresa->delete();
			return redirect()->action('EmpresaController@lista');
		}

		public function atualiza(EmpresasRequest $request){
			$empresa = Empresa::find($request->input('id'));
			$empresa->cnpj = $request->input('cnpj');
			$empresa->razaosocial = $request->input('razaosocial');
			$empresa->ddd = $request->input('ddd');
			$empresa->telefone = $request->input('telefone');
			$empresa->id_cidade = $request->input('cidade');
			$empresa->autorizacontato = $request->input('autorizacontato');
			//$empresa->uf = Request::input('uf');
			
			$empresa->save();

			return redirect()
				->action('EmpresaController@atualizada')
				->withInput(Request::only('razaosocial'));
		}

		public function efetivaEstagio($id){
			$interessevaga = InteresseVaga::find($id);
			$vaga = Vaga::find($interessevaga->id_vaga);
			if (empty($vaga)){
				return view('erro.retorno')->with('mensagem', 'Vaga inválida!');
			}
			if ($vaga->id_user != Auth::id()){
				return view('erro.retorno')->with('mensagem', 'Vaga não pertence ao usuário ativo!');
			}
			$aluno = Aluno::find($interessevaga->id_aluno);
			$curso = Curso::find($aluno->id_curso);
			return view('empresa.efetivaestagio')->with(array('vaga'=>$vaga,'aluno'=>$aluno,'curso'=>$curso,'interessevaga'=>$interessevaga));	
		}

		public function gravaEstagio($id){
			$interessevaga = InteresseVaga::find($id);
			$vaga = Vaga::find($interessevaga->id_vaga);
			if (empty($vaga)){
				return view('erro.retorno')->with('mensagem', 'Vaga inválida!');
			}
			if ($vaga->id_user != Auth::id()){
				return view('erro.retorno')->with('mensagem', 'Vaga não pertence ao usuário ativo!');
			}

			$interessevaga->efetivado = 1;
			$interessevaga->save();

			return redirect()->action('VagaController@lista');

			
		}

		public function estagiosEfetivados(){
			$result = DB::select('select a.ra, a.nome, v.titulo, v.id as id_vaga, e.cnpj, e.razaosocial from interesse_vagas iv 
				                  left join vagas v on iv.id_vaga = v.id
				                  left join empresas e on v.id_user = e.id_user
				                  left join alunos a on iv.id_aluno = a.id
				                  where iv.efetivado = 1');
			return view('empresa.listaefetivados')->with('result', $result);

		}



	} 
