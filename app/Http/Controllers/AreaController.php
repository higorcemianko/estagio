<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\Area;
	use Request;

	class AreaController extends Controller{
		public function nova(){
			return view('area.formulario');
		}

		public function alteraCadastro($id){
			$area = Area::find($id);
			if (empty($area)){
				return "Esta area não existe!";
			}
			return view('area.detalhes')->with('a', $area[0]);
		}

		public function adiciona(){
			//Area::create(Request::all());
			$area = new Area();
			$area->descricao = Request::input('descricao');
			$area->save();

			return redirect()
				->action('AreaController@adicionada')
				->withInput(Request::only('descricao'));
		}

		public function adicionada(){
			return view('area.adicionada');
		}

		public function lista(){
			$areas = Area::all();
			return view('area.lista')->with('areas', $areas);
		}

		public function remove($id){
			$area = Area::find($id);
			$area->delete();
			return redirect()->action('AreaController@lista');
		}

	}