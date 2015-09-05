<?php
   include ('theform.class.php');
    
   $myform = new TheForm();
   echo $myform->openForm('meuform', 'meuform');

   $myform->label_name = 'Nome: ';
   $myform->input_type = 'text';
   $myform->input_name = 'nome';
   $myform->input_placeholder = 'Digite aqui';
   $myform->input_width = '300';
   echo $myform->getField('<p>', '</p>', 'autofocus required');

   $myform->label_name = 'Senha: ';
   $myform->input_type = 'password';
   $myform->input_name = 'senha';
   echo $myform->getField('<p>', '</p>', '', '<br>');

   $myform->input_type = 'checkbox';
   $myform->input_name = 'marcar';
   $myform->label_name = 'Marque essa opção';
   echo $myform->getField('<p>', '</p>', '', '<br>');
   
   $myform->label_name = 'Linguagens de programação: ';
   $myform->input_type = 'select';
   $myform->input_name = 'selecao';
   echo $myform->makeSelect();
   
   $opcoes = array('php' => 'PHP', 'js' => 'JavaScript');
   echo $myform->addOption($opcoes, 'JavaScript');

   $myform->button_value = 'Enviar';
   echo $myform->getButton();
   echo $myform->closeForm();
   
?>