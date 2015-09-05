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
   echo $myform->getField('<p>', '</p>', '', '');

   $myform->input_type = 'checkbox';
   $myform->input_name = 'marcar';
   $myform->label_name = 'Marque essa opção';
   echo $myform->getField('<p>', '</p>', '', '');
   
   $myform->label_name = 'Linguagens de programação: ';
   $myform->input_type = 'select';
   $myform->input_name = 'selecao';
   echo $myform->makeSelect('<p>', 'style="width:100px"');
   
   $opcoes = array('php' => 'PHP', 'js' => 'JavaScript', 'html' => 'HTML');
   echo $myform->addOption($opcoes, 'html', '</p>');
   
   $myform->label_name = 'E-mail: ';
   $myform->input_type = 'email';
   $myform->input_name = 'email';
   $myform->input_width = '200';
   $myform->input_placeholder = 'Digite um e-mail válido';
   $myform->input_required = true;
   echo $myform->getField('<p>','</p>');

   $myform->button_value = 'Enviar';
   echo $myform->getButton();
   echo $myform->closeForm();
   
?>