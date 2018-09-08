<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\Capacidade;
	use Request;

	class CapacidadeController extends Controller{
		public function nova(){
			return view('capacidade.formulario');
		}

		public function alteraCadastro($id){
			$capacidade = Capacidade::find($id);
			if (empty($capacidade)){
				return "Esta capacidade não existe!";
			}
			return view('capacidade.detalhes')->with('c', $capacidade[0]);
		}

		public function adiciona(){
			//Capacidade::create(Request::all());
			$capacidade = new Capacidade();
			$capacidade->descricao = Request::input('descricao');
			$capacidade->save();

			return redirect()
				->action('CapacidadeController@adicionada')
				->withInput(Request::only('descricao'));
		}

		public function adicionada(){
			return view('capacidade.adicionada');
		}

		public function lista(){
			$capacidades = Capacidade::all();
			return view('capacidade.lista')->with('capacidades', $capacidades);
		}

		public function remove($id){
			$capacidade = Capacidade::find($id);
			$capacidade->delete();
			return redirect()->action('CapacidadeController@lista');
		}	
	}