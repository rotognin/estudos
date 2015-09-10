<?php
   define ('DS', DIRECTORY_SEPARATOR);
   
   function moverArquivo($arquivo, $origem, $destino) {
      return rename(trim($origem) . trim($arquivo), trim($destino) . trim($arquivo));
   }

   $config = array();
   $dir_lido = array();
   
   $arq_config = 'config.txt';
   $cfg = fopen($arq_config, 'r');
   
   while (($linha = fgets($cfg)) != '') {
      $lida = explode('=',$linha);
      $config[$lida[0]] = trim($lida[1]);
   }
   
   fclose($cfg);
   
   if (!($monitorar = opendir($config['base']))) {
      echo 'Não foi possível abrir a pasta ' . $config['base'] . PHP_EOL;
      exit;
   }
   
   while (($arquivo = readdir($monitorar)) != '') {
      if (!is_dir($arquivo)) {
         $arq_expl = explode('.', $arquivo);
         $extensao = $arq_expl[count($arq_expl) - 1];
         $caminho = (array_key_exists($extensao, $config)) ? $config[$extensao] : $config['default'];

         if (moverArquivo($arquivo, $config['base'], $caminho)) {
            echo ' - Moveu o arquivo: ' . $arquivo . PHP_EOL;
         } else {
            echo ' - Nao moveu o arquivo: ' . $arquivo . PHP_EOL;
         }
      }
   }
   
   closedir($monitorar);


?>