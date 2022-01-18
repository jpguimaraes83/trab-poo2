<?php

	class CadastroController
	{
		public function index()
		{
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('cadastro.html');

			$objCadastros = Cadastro::selecionaTodos();

			$parametros = array();
			$parametros['cadastros'] = $objCadastros;

			$conteudo = $template->render($parametros);
			echo $conteudo;
		}

		public function create()
		{
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('createcadastro.html');

			$parametros = array();

			$conteudo = $template->render($parametros);
			echo $conteudo;
		}

		public function insert()
		{
			try {
				Cadastro::insert($_POST);

				echo '<script>alert("Cadastro inserido com sucesso!");</script>';
				echo '<script>location.href="http://localhost/trab-poo2/?pagina=cadastro&metodo=index"</script>';
			} catch(Exception $e) {
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/trab-poo2/?pagina=cadastro&metodo=create"</script>';
			}
			
		}

		public function change($paramId)
		{
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('updateCadastro.html');

			$post = Cadastro::selecionaPorId($paramId);

			$parametros = array();
			$parametros['id'] = $post->id;
			$parametros['nome'] = $post->nome;
			$parametros['cpf'] = $post->cpf;
			$parametros['endereco'] = $post->endereco;
			$parametros['telefone'] = $post->telefone;

			$conteudo = $template->render($parametros);
			echo $conteudo;
		}

		public function update()
		{
			try {
				Cadastro::update($_POST);

				echo '<script>alert("Cadastro alterado com sucesso!");</script>';
				echo '<script>location.href="http://localhost/trab-poo2/?pagina=cadastro&metodo=index"</script>';
			} catch (Exception $e) {
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/trab-poo2/?pagina=cadastro&metodo=change&id='.$_POST['id'].'"</script>';
			}
		}

		public function delete($paramId)
		{
			try {
				Cadastro::delete($paramId);

				echo '<script>alert("Cadastro deletado com sucesso!");</script>';
				echo '<script>location.href="http://localhost/trab-poo2/?pagina=cadastro&metodo=index"</script>';
			} catch (Exception $e) {
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/trab-poo2/?pagina=cadastro&metodo=index"</script>';
			}
			
		}
	}
