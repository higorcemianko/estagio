<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
    use estagio\VagaArea;
    use estagio\Vaga;
    use estagio\Area;
    use Request;

    class VagaAreaController extends Controller{
  		public function nova($id_vaga){
  			$areas = DB::select('select a.* from areas a where a.id not in (select va.id_area from vaga_areas va where va.id_vaga = ?)', [$id_vaga]);
			return view('vagaarea.nova')->with(array('v'=>$id_vaga,'areas'=>$areas));
		}

		public function adiciona($id){
			//VagaArea::create($request->all());
			$vagaarea = new VagaArea();
			$vagaarea->id_vaga = $id;//id_vaga = Request::input('vaga');
			$vagaarea->id_area = Request::input('area');
			$vagaarea->save();
			return redirect()
				->action('VagaAreaController@lista', ['id_vaga' => $id]);
				
		}
		
		public function lista($id_vaga){
			$vaga = Vaga::find($id_vaga);
			$vagaareas = DB::select('select va.*, a.descricao from areas a inner join vaga_areas va on a.id = va.id_area where va.id_vaga = ?', [$id_vaga]);
			return view('vagaarea.lista')->with(array('vagaareas'=>$vagaareas, 'vaga'=>$vaga));
		}

		public function confirmaExclusao($id){
			$vagaarea = VagaArea::find($id);
			if(empty($vagaarea)){
				return ('Area inválida!');
			}
			$area = Area::find($vagaarea->id_area);
			return view('vagaarea.confirmaexclusao')->with(array('id'=>$vagaarea->id, 'descricao'=>$area->descricao));
		}

		public function remove($id){
			$vagaarea = VagaArea::find($id);
			$id_vaga = $vagaarea->id_vaga;
			$vagaarea->delete();
			return redirect()
				->action('VagaAreaController@lista', ['id_vaga' => $id_vaga]);
		}



  }