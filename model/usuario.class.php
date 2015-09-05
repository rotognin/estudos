<?php
   /*
      Classe para projeto MVC - tabela exemplo de usuário
      Autor: Rodrigo Tognin
      Data: 04/09/2015
      Localização: Piracicaba, SP, Brasil
      www.rodrigotognin.com.br
   */

   require_once('conexao.class.php');

   class Usuario extends Conexao
   {
      // Campos do Banco de dados
      public $usu_id; // Campo do banco inserido automaticamente
      public $usu_nome;
      public $usu_login;
      public $usu_email;
      public $usu_senha;
      public $usu_profissao;
      public $usu_cidade;
      public $usu_estado;
      public $usu_descricao;
      public $usu_interesse;
      public $usu_status;
      public $usu_datahora; // Campo do banco inserido automaticamente

      public function __construct(){
         $this->conectado = $this->conectar();
      }

      public function preencher($lista) {
         $this->usu_id = $lista['usu_id'];
         $this->usu_nome = $lista['usu_nome'];
         $this->usu_login = $lista['usu_login'];
         $this->usu_email = $lista['usu_email'];
         $this->usu_senha = $lista['usu_senha'];
         $this->usu_profissao = $lista['usu_profissao'];
         $this->usu_cidade = $lista['usu_cidade'];
         $this->usu_estado = $lista['usu_estado'];
         $this->usu_descricao = $lista['usu_descricao'];
         $this->usu_interesse = $lista['usu_interesse'];
         $this->usu_status = $lista['usu_status'];
         $this->usu_datahora = $lista['usu_datahora'];
      }

      // CRUD
      public function carregar($campo, $valor) {
         if ($this->conectado) {
            $comando = 'SELECT * FROM ' . TB_USUARIOS .
                       ' WHERE ' . $campo . ' = ' . $this->aspas($valor);

            if (!($lista = $this->consultar($comando))) {
               return false;
            }

            $this->preencher($lista);
            return true;
         } else {
            return false;
         }
      }

      public function inserir() {
         if ($this->conectado) {
            $comando = 'INSERT INTO ' . TB_USUARIOS .
                       ' (usu_nome, usu_login, usu_email, usu_senha, ' .
                       'usu_profissao, usu_cidade, usu_estado, ' .
                       'usu_descricao, usu_interesse, usu_status) ' .
                       'VALUES (' .
                       $this->aspas($this->usu_nome) . ', ' .
                       $this->aspas($this->usu_login) . ', ' .
                       $this->aspas($this->usu_email) . ', ' .
                       $this->aspas(sha1($this->usu_senha)) . ', ' .
                       $this->aspas($this->usu_profissao) . ', ' .
                       $this->aspas($this->usu_cidade) . ', ' .
                       $this->aspas($this->usu_estado) . ', ' .
                       $this->aspas($this->usu_descricao) . ', ' .
                       $this->aspas($this->usu_interesse) . ', ' .
                       $this->aspas($this->usu_status) . ')';

            $resultado = $this->executar($comando);
            if ($this->registros($resultado) > 0) {
               return true;
            } else {
               return false;
            }
         } else {
            return false;
         }
      }

      public function atualizar($lista = array()) {
         // Se veio algo no array, atualizar apenas os campos dele.
         // Se não veio nada no array, atualizar a partir dos atributos
         // do objeto.

         if ($this->conectado) {
            $comando = 'UPDATE ' . TB_USUARIOS . ' SET ';

            if (count($lista) > 0) {
               foreach ($lista as $chave => $valor) {
                  $comando .= $chave . ' = ' . $this->aspas($valor) . ', ';
               }

               $comando = substr($comando, 0, -2);
            } else {
               $comando .= 'usu_nome = ' . $this->aspas($this->usu_nome) . ', ' .
                           'usu_login = ' . $this->aspas($this->usu_login) . ', ' .
                           'usu_email = ' . $this->aspas($this->usu_email) . ', ' .
                           'usu_profissao = ' . $this->aspas($this->usu_profissao) . ', ' .
                           'usu_cidade = ' . $this->aspas($this->usu_cidade) . ', ' .
                           'usu_estado = ' . $this->aspas($this->usu_estado) . ', ' .
                           'usu_descricao = ' . $this->aspas($this->usu_descricao) . ', ' .
                           'usu_interesse = ' . $this->aspas($this->usu_interesse) . ', ' .
                           'usu_status = ' . $this->aspas($this->usu_status) . ' ';
            }

            $comando .= 'WHERE usu_id = ' . $this->usu_id;

            $resultado = $this->execQuery($comando);
            if ($resultado > 0) {
               return true;
            } else {
               return false;
            }
         } else {
            return false;
         }
      }

      // Método que irá apagar o usuário do banco.
      // Poderão ser implementados controles adicionais, mas nesse
      // caso será apagado o usuário que está carregado no objeto
      public function apagar(){
         if (is_int($this->usu_id) && ($this->usu_id > 0)) {
            $comando = 'DELETE FROM ' . TB_USUARIOS .
                       ' WHERE usu_id = ' . $this->usu_id;

            $resultado = $this->executar($comando);
            if ($this->registros($resultado) > 0) {
               return true;
            } else {
               return false;
            }
         } else {
            return false;
         }
      }
   }
?>