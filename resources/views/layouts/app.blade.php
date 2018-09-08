<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/vendor/artesaos/cidades/js/scripts.js"></script>
    <title>{{ config('name', 'Sistema Gerenciamento Estágio - UNESP') }}</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
        body {
            background-color: white;
            font-family: verdana;
        }

        nav.navbar {
            background-color: #00BFFF;
            color: black;
        }

        ul.dropdown-menu {
            background-color: #00BFFF;
            color: black;   
        }

        li.dropdown a.dropdown-toggle {
            color: black;   
        }

        li.dropdown a.dropdown-toggle:hover:not(.active) {
            background-color: #ADD8E6;
        }

        ul.dropdown-menu:hover:not(.active) {
            background-color: #ADD8E6;
        }

        ul.navbar.navbar-nav.navbar-right {
            color: black;   
        }       
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" >
            <div class="container" >
                <div class="navbar-header" >

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <font color="black" ><b>{{ config('name', 'Sistema de Gerenciamento de Estágio - UNESP') }}</b></font>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}" style="color: black">Login</a></li>
                            <li><a href="{{ route('register') }}" style="color: black">Cadastrar-se</a></li>
                        @else
                            @role(array('Admin','Empresa','Aluno'))
                                @role(array('Admin','Empresa'))
                                    <li class="dropdown">                                
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Empresas <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                @role('Admin')
                                                    <a href="{{action('EmpresaController@lista')}}">Todas as empresas</a>
                                                    <a href="{{action('EmpresaController@nova')}}">Nova empresa</a>
                                                @endrole
                                                @role('Empresa')
                                                    <a href="{{action('EmpresaController@alteraCadastroUser')}}">Dados da empresa</a>
                                                @endrole
                                            </li>
                                        </ul>   
                                    </li>
                                @endrole
                                @role(array('Admin', 'Aluno'))
                                    <li class="dropdown">                                
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Alunos <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                @role('Admin')
                                                    <a href="{{action('AlunoController@lista')}}">Todos os alunos</a>
                                                    <a href="{{action('AlunoController@novo')}}">Novo aluno</a>
                                                @endrole
                                                @role('Aluno')
                                                    <a href="{{action('AlunoController@alteraCadastroUser')}}">Dados do aluno</a>
                                                    <a href="{{action('AlunoAreaController@lista')}}">Áreas</a>
                                                    <a href="{{action('AlunoCapacidadeController@lista')}}">Capacidades</a>
                                                    <a href="{{action('AlunoDiferencialController@lista')}}">Diferenciais</a>                                                                    
                                                @endrole
                                            </li>
                                        </ul>   
                                    </li>
                                @endrole

                                @role('Admin')
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Area <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{action('AreaController@lista')}}">Todas as areas</a>
                                                <a href="{{action('AreaController@nova')}}">Nova area</a>
                                            </li>
                                        </ul>
                                        
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Capacidade <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{action('CapacidadeController@lista')}}">Todas as capacidades</a>
                                                <a href="{{action('CapacidadeController@nova')}}">Nova capacidade</a>
                                            </li>
                                        </ul>
                                        
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                             Diferenciais <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{action('DiferencialController@lista')}}">Todas os diferenciais</a>
                                                <a href="{{action('DiferencialController@novo')}}">Nova diferencial</a>
                                            </li>
                                        </ul>
                                        
                                    </li>
                                                          
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Curso <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{action('CursoController@lista')}}">Todos os cursos</a>
                                                <a href="{{action('CursoController@novo')}}">Novo curso</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Papel de Usuário <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{action('RoleUserController@novo')}}">Novo</a>
                                                <a href="{{action('ExcelController@carregaArquivo')}}">Importar Usuários</a>
                                                <a href="{{action('RoleUserController@empresasPendentes')}}">Cadastros Pendentes</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Vagas <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{action('EmpresaController@estagiosEfetivados')}}">Estágios Efetivados</a>
                                                <a href="{{action('VagaController@listaAdmin')}}">Todas as vagas</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endrole
                                @role(array('Empresa', 'Aluno'))
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Vagas <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                @role('Empresa')
                                                    <a href="{{action('VagaController@lista')}}">Todas as vagas</a>
                                                    <a href="{{action('VagaController@nova')}}">Nova vaga</a>
                                                @endrole
                                                @role('Aluno')
                                                    <a href="{{action('AlunoController@buscaVagas')}}">Buscar Vagas</a>
                                                    <a href="{{action('AlunoController@buscaInteresses')}}">Meus Interesses</a>
                                                @endrole
                                            </li>
                                        </ul>
                                    </li>
                                @endrole
                            @else
                                <li><a href="{{action('EmpresaController@nova')}}" style="color: black">Soliciar Cadastro</a></li>
                            @endrole    
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>        
                        @endif
                        
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/artesaos/cidades/js/scripts.js') }}"></script>
    <script>
          $('#uf').ufs({
              onChange: function(uf){
                  $('#cidade').cidades({uf: uf});
              }
          });
    </script>
    <script type="text/javascript">
        function validarEmpresa(cnpj, razaosocial, cidade) {
 
            //cnpj = cnpj.replace(/[^\d]+/g,'');
            msgcnpj = "Informe um CNPJ válido!";
            msgrazao = "Informe uma Razão Social";
            msgcidade = "Informe uma Cidade";
         
            if(cnpj == ''){
                document.getElementById("error").innerHTML = msgcnpj;
                return false;
            } 
            
             
            if (cnpj.length != 14){
                document.getElementById("error").innerHTML = msgcnpj;
                return false;
            }
                
         
            // Elimina CNPJs invalidos conhecidos
            if (cnpj == "00000000000000" || 
                cnpj == "11111111111111" || 
                cnpj == "22222222222222" || 
                cnpj == "33333333333333" || 
                cnpj == "44444444444444" || 
                cnpj == "55555555555555" || 
                cnpj == "66666666666666" || 
                cnpj == "77777777777777" || 
                cnpj == "88888888888888" || 
                cnpj == "99999999999999"){
                document.getElementById("error").innerHTML = msgcnpj;
                return false;
            }
                
                 
            // Valida DVs
            tamanho = cnpj.length - 2
            numeros = cnpj.substring(0,tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
              soma += numeros.charAt(tamanho - i) * pos--;
              if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0)){
                document.getElementById("error").innerHTML = msgcnpj;
                return false;
            }
                
                 
            tamanho = tamanho + 1;
            numeros = cnpj.substring(0,tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
              soma += numeros.charAt(tamanho - i) * pos--;
              if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1)){
                document.getElementById("error").innerHTML = msgcnpj;
                return false;
            }

            if (razaosocial == ''){
                document.getElementById("error").innerHTML = msgrazao;
                return false;
            }

            document.getElementById("error").innerHTML = cidade;
            if (parseInt(cidade) == 0){
                document.getElementById("error").innerHTML = msgcidade;
                return false;   
            }
                  
                   
            return true;
    
        }
    </script>
</body>
</html>
