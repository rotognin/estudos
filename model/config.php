<?php
   /*
      Classe para projeto MVC - arquivo com a configuração de conexão
      Autor: Rodrigo Tognin
      Data: 04/09/2015
      Localização: Piracicaba, SP, Brasil
      www.rodrigotognin.com.br
   */

   // Constantes para conexão com pdo
   define ("DB_HOST","localhost");
   define ("DB_NAME","database_db");
   define ("DB_USER","root");
   define ("DB_PASS","123");

   // Utilizando PDO para conectar em um banco MySQL
   // Para conexão com outros DB´s, alterar o $db_drive
   $db_drive = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
?>