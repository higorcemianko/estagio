<?php namespace estagio\Http\Controllers;	
	use Illuminate\Support\Facades\DB;
	use estagio\VagaCapacidade;
	use estagio\Vaga;
	use estagio\Capacidade;
	use Request;
	

	class VagaCapacidadeController extends Controller{
	  	public function nova($id_vaga){
  			$capacidades = DB::select('select c.* from capacidades c where c.id not in (select vc.id_capacidade from vaga_capacidades vc where vc.id_vaga = ?)', [$id_vaga]);
			return view('vagacapacidade.nova')->with(array('v'=>$id_vaga,'capacidades'=>$capacidades));
		}

		public function adiciona($vaga){
			//Vagacapacidade::create($request->all());
			$vagacapacidade = new VagaCapacidade();
			$vagacapacidade->id_vaga = $vaga;
			$vagacapacidade->id_capacidade = Request::input('capacidade');
			$vagacapacidade->save();
			return redirect()
				->action('VagaCapacidadeController@lista', ['id_vaga' => $vaga]);
				
		}

		
		public function lista($id_vaga){
			$vaga = Vaga::find($id_vaga);
			$vagacapacidades = DB::select('select vc.*, c.descricao from capacidades c inner join vaga_capacidades vc on c.id = vc.id_capacidade where vc.id_vaga = ?', [$id_vaga]);
			return view('vagacapacidade.lista')->with(array('vagacapacidades'=>$vagacapacidades, 'vaga'=>$vaga));
		}

		public function confirmaExclusao($id){
			$vagacapacidade = VagaCapacidade::find($id);
			if(empty($vagacapacidade)){
				return ('Capacidade inválida!');
			}
			$capacidade = Capacidade::find($vagacapacidade->id_capacidade);
			return view('vagacapacidade.confirmaexclusao')->with(array('id'=>$vagacapacidade->id, 'descricao'=>$capacidade->descricao));
		}

		public function remove($id){
			$vagacapacidade = VagaCapacidade::find($id);
			$id_vaga = $vagacapacidade->id_vaga;
			$vagacapacidade->delete();
			return redirect()
				->action('VagaCapacidadeController@lista', ['id_vaga' => $id_vaga]);
		}


	  }