<?php

	class Cadastro
	{

		public static function selecionaTodos()
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM joaoguimaraes.cadastro ORDER BY id DESC";
			$sql = $con->prepare($sql);
			$sql->execute();

			$resultado = array();

			while ($row = $sql->fetchObject('Cadastro')) {
				$resultado[] = $row;
			}

			if (!$resultado) {
				throw new Exception("Não foi encontrado nenhum registro no banco");		
			}

			return $resultado;
		}

		public static function selecionarCadastros($idPost)
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM joaoguimaraes.cadastro WHERE id = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
			$sql->execute();

			$resultado = array();

			while ($row = $sql->fetchObject('Cadastro')) {
				$resultado[] = $row;
			}

			return $resultado;
		}

		public static function selecionaPorId($idPost)
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM joaoguimaraes.cadastro WHERE id = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
			$sql->execute();

			$resultado = $sql->fetchObject('Cadastro');

			return $resultado;
		}

		public static function insert($dadosPost)
		{
			if (empty($dadosPost['nome']) OR empty($dadosPost['cpf']) OR empty($dadosPost['endereco'])OR empty($dadosPost['telefone'])) {
				throw new Exception("Preencha todos os campos");

				return false;
			}

			$con = Connection::getConn();

			$sql = $con->prepare('INSERT INTO joaoguimaraes.cadastro (nome, cpf, endereco, telefone) VALUES (:nome, :cpf, :endereco, :telefone)');
			$sql->bindValue(':nome', $dadosPost['nome']);
			$sql->bindValue(':cpf', $dadosPost['cpf']);
			$sql->bindValue(':endereco', $dadosPost['endereco']);
			$sql->bindValue(':telefone', $dadosPost['telefone']);
			$res = $sql->execute();

			if ($res == 0) {
				throw new Exception("Falha ao inserir cadastro");

				return false;
			}

			return true;
		}

		public static function update($params)
		{
			$con = Connection::getConn();

			$sql = "UPDATE joaoguimaraes.cadastro SET nome = :nome, cpf = :cpf, endereco = :endereco, telefone = :telefone WHERE id = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':nome', $params['nome']);
			$sql->bindValue(':cpf', $params['cpf']);
			$sql->bindValue(':endereco', $params['endereco']);
			$sql->bindValue(':telefone', $params['telefone']);
			$sql->bindValue(':id', $params['id']);
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao alterar cadastro");

				return false;
			}

			return true;
		}

		public static function delete($id)
		{
			$con = Connection::getConn();

			$sql = "DELETE FROM joaoguimaraes.cadastro WHERE id = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $id);
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao deletar publicação");

				return false;
			}

			return true;
		}

	}
