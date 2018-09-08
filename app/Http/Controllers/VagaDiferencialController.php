<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\VagaDiferencial;
	use estagio\Vaga;
	use estagio\Diferencial;
    use Request;

	class VagaDiferencialController extends Controller{
	  	public function nova($id_vaga){
  			$diferenciais = DB::select('select d.* from diferenciais d where d.id not in (select vd.id_diferencial from vaga_diferenciais vd where vd.id_vaga = ?)', [$id_vaga]);
			return view('vagadiferencial.nova')->with(array('v'=>$id_vaga,'diferenciais'=>$diferenciais));
		}

		public function adiciona($vaga){
			//Vagadiferencial::create($request->all());
			$vagadiferencial = new VagaDiferencial();
			$vagadiferencial->id_vaga = $vaga;//id_vaga = Request::input('vaga');
			$vagadiferencial->id_diferencial = Request::input('diferencial');
			$vagadiferencial->save();
			return redirect()
				->action('VagaDiferencialController@lista', ['id_vaga' => $vaga]);
				
		}

		
		public function lista($id_vaga){
			$vaga = Vaga::find($id_vaga);
			$vagadiferenciais = DB::select('select vd.*, d.descricao from diferenciais d inner join vaga_diferenciais vd on d.id = vd.id_diferencial where vd.id_vaga = ?', [$id_vaga]);
			return view('vagadiferencial.lista')->with(array('vagadiferenciais'=>$vagadiferenciais, 'vaga'=>$vaga));
		}

		public function confirmaExclusao($id){
			$vagadiferencial = VagaDiferencial::find($id);
			if(empty($vagadiferencial)){
				return ('Diferencial inválido!');
			}
			$diferencial = Diferencial::find($vagadiferencial->id_diferencial);
			return view('vagadiferencial.confirmaexclusao')->with(array('id'=>$vagadiferencial->id, 'descricao'=>$diferencial->descricao));
		}

		public function remove($id){
			$vagadiferencial = VagaDiferencial::find($id);
			$id_vaga = $vagadiferencial->id_vaga;
			$vagadiferencial->delete();
			return redirect()
				->action('VagaDiferencialController@lista', ['id_vaga' => $id_vaga]);
		}


	  }