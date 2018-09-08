<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\Diferencial;
	use Request;

	class DiferencialController extends Controller{
		public function novo(){
			return view('diferencial.formulario');
		}

		public function alteraCadastro($id){
			$diferencial = Diferencial::find($id);
			if (empty($diferencial)){
				return "Este diferencial não existe!";
			}
			return view('diferencial.detalhes')->with('d', $diferencial[0]);
		}

		public function adiciona(){
			//Diferencial::create(Request::all());
			$diferencial = new Diferencial();
			$diferencial->descricao = Request::input('descricao');
			$diferencial->save();

			return redirect()
				->action('DiferencialController@adicionado')
				->withInput(Request::only('descricao'));
		}

		public function adicionado(){
			return view('diferencial.adicionado');
		}

		public function lista(){
			$diferenciais = Diferencial::all();
			return view('diferencial.lista')->with('diferenciais', $diferenciais);
		}

		public function remove($id){
			$diferencial = Diferencial::find($id);
			$diferencial->delete();
			return redirect()->action('DiferencialController@lista');
		}

	}