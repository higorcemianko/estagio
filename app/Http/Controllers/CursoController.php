<?php namespace estagio\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use estagio\Curso;
	use Request;

	class CursoController extends Controller{
		public function novo(){
			return view('curso.formulario');
		}

		public function alteraCadastro($id){
			$curso = Curso::find($id);
			if (empty($curso)){
				return "Este curso não existe!";
			}
			return view('curso.detalhes')->with('c', $curso[0]);
		}

		public function adiciona(){
			//Curso::create(Request::all());
			$curso = new Curso();
			$curso->codigo = Request::input('codigo');
			$curso->descricao = Request::input('descricao');
			$curso->save();

			return redirect()
				->action('CursoController@adicionado')
				->withInput(Request::only('descricao'));
		}

		public function adicionado(){
			return view('curso.adicionado');
		}

		public function lista(){
			$cursos = Curso::all();
			return view('curso.lista')->with('cursos', $cursos);
		}

		public function remove($id){
			$curso = Curso::find($id);
			$curso->delete();
			return redirect()->action('CursoController@lista');
		}

	}