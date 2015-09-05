<?php
   /*
      Classe para projeto MVC - tabela exemplo de conexão
      Autor: Rodrigo Tognin
      Data: 04/09/2015
      Localização: Piracicaba, SP, Brasil
      www.rodrigotognin.com.br
   */

   include('tabelas.php');

   abstract class Conexao
   {
      public $conn;
      public $conectado;
      public $mensagem_erro;

      public function conectar(){
         include('config.php');

         try
         {
            $this->conn = new PDO($db_drive, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch(PDOException $erro)
         {
            $msg_erro = $erro->getMessage();
            $this->mensagem_erro = 'Erro ao acessar o banco de dados: ' . $msg_erro;
            return false;
         }

         $this->conn->exec('SET NAMES utf8');
         return true;
      }

      // Função simples para adicionar aspas a campos String.
      public function aspas($valor) {
         if (is_string($valor)) {
            return "'" . $valor . "'";
         } else {
            return $valor;
         }
      }

      // Essa função de consulta retorna o primeiro resultado encontrado
      // em um array com os campos pesquisados.
      // Recomendado o uso apenas para ler e trazer um registro, sem
      // precisar ler mais de um.
      public function consultar($comando) {
         $resultado = $this->conn->query($comando);
         
         if ($this->registros($resultado) > 0) {
            return $this->lista($resultado);
         } else {
            return false;
         }
      }

      // Essa função faz a consulta no banco e retorna o objeto da consulta
      // para ser utilizado em conjunto com a função "lista",
      // e pode ser utilizada também para inserção e atualização dos
      // dados no banco.
      public function executar($comando) {
         return $this->conn->query($comando);
      }

      // Aqui a query é executada e o retorno será o número de
      // linhas que foram afetadas, ao contrário do "executar", que
      // retorna um objeto de conexão.
      // Recomendado para ser utilizado em Updates e Deletes
      public function execQuery($comando) {
         $resultado = $this->conn->exec($comando);

         if (is_int($resultado) && ($resultado > 0)) {
            return $resultado;
         } else {
            return 0;
         }
      }

      // Após ter o objeto de consulta no banco, esse método faz a leitura
      // resultado-a-resultado no banco, conforme necessário.
      public function lista($resultado) {
         return $resultado->fetch(PDO::FETCH_ASSOC);
      }

      // Esse método retorna o total de resultado lido, ou 0 (zero) quando
      // não houver resultados.
      public function registros($resultado) {
         $numero = $resultado->rowCount();

         if (is_int($numero) && ($numero > 0)) {
            return $numero;
         } else {
            return 0;
         }
      }

      // Método que retorna o último ID inserido/Alterado no banco
      public function ultimoId() {
         return $this->conn->lastInsertId();
      }
   }
?>