<?php
   include ('theform.class.php');
    
   $myform = new TheForm();
   $myform->form_before = '<h1>Cadastro</h1>';
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
   $myform->placeholder = 'Digite aqui';
   $myform->width = '300';
   $myform->height = '30';
   $myform->maxlength = '15';
   $myform->before_field = '<p>';
   $myform->after_field = '</p>';
   $myform->add_to_field = 'data-teste="01"';
   echo $myform->getField();
   
   $myform->before_field = 'Escolha uma:<br>';
   $myform->label_name = 'PHP';
   $myform->type = 'radio';
   $myform->id = 'php';
   $myform->name = 'linguagem';
   $myform->value = 'php';
   echo $myform->getField();
   
   $myform->before_field = '&nbsp;&nbsp;&nbsp;';
   $myform->label_name = 'JavaScript';
   $myform->type = 'radio';
   $myform->id = 'js';
   $myform->name = 'linguagem';
   $myform->value = 'js';
   echo $myform->getField();
   
   $myform->before_field = '&nbsp;&nbsp;&nbsp;';
   $myform->label_name = 'Python';
   $myform->type = 'radio';
   $myform->id = 'python';
   $myform->name = 'linguagem';
   $myform->value = 'python';
   $myform->after_field = '<br>';
   echo $myform->getField();

   $myform->label_name = 'Digite sua escolha de linguagem: ';
   $myform->type = 'list';
   $myform->id = 'data1';
   $myform->name = 'datalist';
   $myform->required = true;
   $myform->options = array('PHP', 'JS', 'Python', 'C++');
   echo $myform->getField();
   
   $myform->before_field = '<hr>';
   $myform->label_name = 'Escolha uma liguagem: ';
   $myform->type = 'select';
   $myform->id = 'select1';
   $myform->name = 'linguagem1';
   $myform->value = 'js';
   $myform->width = '300';
   $myform->options = array('php' => 'PHP',
                            'js' => 'JavaScript',
                            'python' => 'Python',
                            'c++' => 'C++');
   $myform->after_field = '<hr>';
   echo $myform->getField();
   
   $myform->before_field = '<p>';
   $myform->label_name = 'PHP';
   $myform->label_is_before = false;
   $myform->type = 'checkbox';
   $myform->name = 'php';
   $myform->id = 'chk_php';
   echo $myform->getField();
   
   $myform->label_name = 'JavaScript';
   $myform->label_is_before = false;
   $myform->type = 'checkbox';
   $myform->name = 'js';
   $myform->id = 'chk_js';
   echo $myform->getField();
   
   $myform->label_name = 'Python';
   $myform->label_is_before = false;
   $myform->type = 'checkbox';
   $myform->name = 'python';
   $myform->id = 'chk_python';
   echo $myform->getField();
   
   $myform->label_name = 'C++';
   $myform->label_is_before = false;
   $myform->type = 'checkbox';
   $myform->name = 'c++';
   $myform->id = 'chk_c++';
   $myform->after_field = '</p>';
   echo $myform->getField();
   
   $myform->button_type = 'submit';
   $myform->button_value = 'Enviar';
   echo $myform->getButton();
   echo $myform->closeForm();
   
?>