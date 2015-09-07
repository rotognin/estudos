<?php
   include ('theform.class.php');
    
   $myform = new TheForm();
   $myform->form_before = '<h1>Cadastro</h1><br>';
   $myform->form_after = '<hr><p>2015 - Rodrigo Tognin</p>';
   $myform->form_name = 'cadastro';
   $myform->form_id = 'cad001';
   $myform->form_action = 'foi.php';
   $myform->form_method = 'post';
   $myform->form_target = '_blank';
   echo $myform->openForm();

   $myform->label_id = 'lb001';
   $myform->label_name = 'Nome: ';
   $myform->label_add_between = '<br>';
   $myform->id = 'id_input';
   $myform->type = 'text';
   $myform->name = 'nome';
   $myform->value = 'nao_precisa';
   $myform->placeholder = 'Digite aqui';
   $myform->width = '300';
   $myform->height = '50';
   $myform->maxlength = '15';
   $myform->before_field = '<p>';
   $myform->after_field = '</p>';
   $myform->add_to_field = 'data-teste="01"';
   echo $myform->getField();

   $myform->button_type = 'submit';
   $myform->button_value = 'Enviar';
   echo $myform->getButton();
   echo $myform->closeForm();
   
?>