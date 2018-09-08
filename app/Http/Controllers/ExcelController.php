<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\Aluno;
	use estagio\Curso;
	use estagio\User;
	use estagio\RoleUser;
	use Auth;
	use estagio\Http\Requests\AlunosRequest;
	use Requests;
	use Excel;
	use Illuminate\Http\Request;

	class ExcelController extends Controller{
		public function __construct(){

		}

		public function carregaArquivo(){
			return view('excel.carregar');
		}

		public function importaUsers(Request $request){
			if (!$request->hasFile('import_file')){
				return view('erro.retorno')->with('mensagem', 'Arquivo de importação não informado!');
			}
			
			$path = $request->file('import_file')->getRealPath();

			$data = Excel::load($path, function($reader) {})->get();
			$cont = 0;
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					if ($value->email == null || $value->email == ' ')
						break;
					$user = new User();
					$user = User::create([
			            'name' => $value->nome,
			            'email' => $value->email,
			            'password' => bcrypt($value->senha),
        			]);
					/*$user->email = $value->email;
					$user->password = bcrypt($value->senha);
					$user->name = $value->nome;
					$user->save();*/

					$aluno = new Aluno();
					$aluno->ra = $value->ra;
					$aluno->dt_nasc = $value->nascimento;
					$aluno->nome = $value->nome;
					$aluno->ddd = $value->ddd;
					$aluno->telefone = $value->telefone;
					$aluno->id_user = $user->id;
					$result = DB::select('select * from cursos where codigo = ?', [$value->curso]);
					$id_curso = 0;
					foreach ($result as $res) {
						$id_curso = $res->id;	
					}
					$curso = Curso::find($id_curso);
					$aluno->id_curso = $curso->id;
					$aluno->save();

					$roleuser = new RoleUser();
					$roleuser->user_id = $user->id;
					$roleuser->role_id = 2;
					$roleuser->save();

					$cont++;
				}
				return view('excel.importado')->with('cont', $cont);			
				

			}
			else{
				return view('erro.retorno')->with('mensagem', 'Arquivo sem dados para importação!');
			}            
			
			
		}

	}
