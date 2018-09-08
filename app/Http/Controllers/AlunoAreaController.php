<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
    use estagio\AlunoArea;
    use estagio\Aluno;
    use estagio\Area;
    use Request;
    use Auth;

    class alunoAreaController extends Controller{
  		public function nova($id_aluno){
  			$areas = DB::select('select a.* from areas a where a.id not in (select al.id_area from aluno_areas al where al.id_aluno = ?)', [$id_aluno]);
			return view('alunoarea.nova')->with(array('al'=>$id_aluno,'areas'=>$areas));
		}

		public function adiciona($id){
			//alunoArea::create($request->all());
			$alunoarea = new AlunoArea();
			$alunoarea->id_aluno = $id;//id_aluno = Request::input('aluno');
			$alunoarea->id_area = Request::input('area');
			$alunoarea->save();
			return redirect()
				->action('AlunoAreaController@lista', ['id_aluno' => $id]);
				
		}
		
		public function lista(){
			$id = 0;
			$result = DB::select('select * from alunos where id_user = ?', [Auth::id()]);
			foreach ($result as $res) {
				$id = $res->id;	
			}

			$aluno = Aluno::find($id);
			$alunoareas = DB::select('select al.*, a.descricao from areas a inner join aluno_areas al on a.id = al.id_area where al.id_aluno = ?', [$aluno->id]);
			return view('alunoarea.lista')->with(array('alunoareas'=>$alunoareas, 'aluno'=>$aluno));
		}

		public function confirmaExclusao($id){
			$alunoarea = AlunoArea::find($id);
			if(empty($alunoarea)){
				return ('Area inválida!');
			}
			$area = Area::find($alunoarea->id_area);
			return view('alunoarea.confirmaexclusao')->with(array('id'=>$alunoarea->id, 'descricao'=>$area->descricao));
		}

		public function remove($id){
			$alunoarea = AlunoArea::find($id);
			$id_aluno = $alunoarea->id_aluno;
			$alunoarea->delete();
			return redirect()
				->action('AlunoAreaController@lista', ['id_aluno' => $id_aluno]);
		}



  }