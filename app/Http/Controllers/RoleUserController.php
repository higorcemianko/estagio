<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\RoleUser;
	use Request;
	use estagio\Role;
	use estagio\User;
	use estagio\Empresa;
	use Auth;
	class RoleUserController extends Controller{
		public function __construct(){

		}

		public function novo(){
			$roles = Role::all();
			$users = DB::select('select * from users');
			return view('roleuser.formulario')->with(array('roles'=>$roles,'users'=>$users));
		}

		public function adiciona(){
			$roleuser = new RoleUser();
			$roleuser->user_id = Request::input('user');
			$roleuser->role_id = Request::input('role');
			$roleuser->save();

			return redirect()
				->action('RoleUserController@adicionado');
		}

		public function adicionado(){
			return view('roleuser.adicionado');
		}

		public function empresasPendentes(){
			$result = DB::select('select u.id, u.email, e.id as id_emp, e.cnpj, e.razaosocial, e.telefone from users u inner join empresas e on u.id = e.id_user 
				                  where u.id not in (select r.user_id from role_user r 
				                  	                 where r.role_id = 3)');
			return view('roleuser.empresaspendentes')->with('pendentes',$result);

		}

		public function confirmaCadastro($id_emp){
			$empresa = Empresa::find($id_emp);

			if (empty($empresa)){
				//return "Esta empresa não existe!";
				return view('erro.retorno')->with('mensagem', 'Empresa não existe!');
			}

			$user = User::find($empresa->id_user);
			if(empty($user)){
				return view('erro.retorno')->with('mensagem', 'Usuário não existe!');
			}

			return view('roleuser.confirmacadastro')->with(array('empresa'=>$empresa, 'user'=>$user));

		}

		public function aceitaCadastro($id){
			$user = User::find($id);
			if(empty($user)){
				return view('erro.retorno')->with('mensagem', 'Usuário não existe!');
			}

			$roleuser = new RoleUser();
			$roleuser->user_id = $user->id;
			$roleuser->role_id = 3;
			$roleuser->save();

			return redirect()
				->action('RoleUserController@adicionado');

		}

	}