<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\AlunoDiferencial;
	use estagio\Aluno;
	use estagio\Diferencial;
    use Request;
    use Auth;

	class AlunoDiferencialController extends Controller{
	  	public function nova($id_aluno){
  			$diferenciais = DB::select('select d.* from diferenciais d where d.id not in (select ad.id_diferencial from aluno_diferenciais ad where ad.id_aluno = ?)', [$id_aluno]);
			return view('alunodiferencial.nova')->with(array('v'=>$id_aluno,'diferenciais'=>$diferenciais));
		}

		public function adiciona($aluno){
			//alunodiferencial::create($request->all());
			$alunodiferencial = new AlunoDiferencial();
			$alunodiferencial->id_aluno = $aluno;//id_aluno = Request::input('aluno');
			$alunodiferencial->id_diferencial = Request::input('diferencial');
			$alunodiferencial->save();
			return redirect()
				->action('AlunoDiferencialController@lista', ['id_aluno' => $aluno]);
				
		}

		
		public function lista(){
			$id = 0;
			$result = DB::select('select * from alunos where id_user = ?', [Auth::id()]);
			foreach ($result as $res) {
				$id = $res->id;	
			}
			$aluno = Aluno::find($id);
			$alunodiferenciais = DB::select('select ad.*, d.descricao from diferenciais d inner join aluno_diferenciais ad on d.id = ad.id_diferencial where ad.id_aluno = ?', [$aluno->id]);
			return view('alunodiferencial.lista')->with(array('alunodiferenciais'=>$alunodiferenciais, 'aluno'=>$aluno));
		}

		public function confirmaExclusao($id){
			$alunodiferencial = AlunoDiferencial::find($id);
			if(empty($alunodiferencial)){
				return ('Diferencial inválido!');
			}
			$diferencial = Diferencial::find($alunodiferencial->id_diferencial);
			return view('alunodiferencial.confirmaexclusao')->with(array('id'=>$alunodiferencial->id, 'descricao'=>$diferencial->descricao));
		}

		public function remove($id){
			$alunodiferencial = AlunoDiferencial::find($id);
			$id_aluno = $alunodiferencial->id_aluno;
			$alunodiferencial->delete();
			return redirect()
				->action('AlunoDiferencialController@lista', ['id_aluno' => $id_aluno]);
		}


	  }