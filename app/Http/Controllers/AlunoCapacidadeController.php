<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
    use estagio\AlunoCapacidade;
    use estagio\Aluno;
    use estagio\Capacidade;
    use Request;
    use Auth;

    class alunoCapacidadeController extends Controller{
  		public function nova($id_aluno){
  			$capacidades = DB::select('select c.* from capacidades c where c.id not in (select ac.id_capacidade from aluno_capacidades ac where ac.id_aluno = ?)', [$id_aluno]);
			return view('alunocapacidade.nova')->with(array('ac'=>$id_aluno,'capacidades'=>$capacidades));
		}

		public function adiciona($id){
			//alunoCapacidade::create($request->all());
			$alunocapacidade = new AlunoCapacidade();
			$alunocapacidade->id_aluno = $id;//id_aluno = Request::input('aluno');
			$alunocapacidade->id_capacidade = Request::input('capacidade');
			$alunocapacidade->save();
			return redirect()
				->action('AlunoCapacidadeController@lista', ['id_aluno' => $id]);
				
		}
		
		public function lista(){
			$id = 0;
			$result = DB::select('select * from alunos where id_user = ?', [Auth::id()]);
			foreach ($result as $res) {
				$id = $res->id;	
			}
			$aluno = Aluno::find($id);
			$alunocapacidades = DB::select('select ac.*, c.descricao from capacidades c inner join aluno_capacidades ac on c.id = ac.id_capacidade where ac.id_aluno = ?', [$aluno->id]);
			return view('alunocapacidade.lista')->with(array('alunocapacidades'=>$alunocapacidades, 'aluno'=>$aluno));
		}

		public function confirmaExclusao($id){
			$alunocapacidade = AlunoCapacidade::find($id);
			if(empty($alunocapacidade)){
				return ('Capacidade inválida!');
			}
			$capacidade = Capacidade::find($alunocapacidade->id_capacidade);
			return view('alunocapacidade.confirmaexclusao')->with(array('id'=>$alunocapacidade->id, 'descricao'=>$capacidade->descricao));
		}

		public function remove($id){
			$alunocapacidade = AlunoCapacidade::find($id);
			$id_aluno = $alunocapacidade->id_aluno;
			$alunocapacidade->delete();
			return redirect()
				->action('AlunoCapacidadeController@lista', ['id_aluno' => $id_aluno]);
		}



  }