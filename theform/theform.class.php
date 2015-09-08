<?php
   /*
      Classe para gerar formulários em HTML
      Autor: Rodrigo Tognin
      Data: 03/09/2015
      Localização: Piracicaba, SP, Brasil
      www.rodrigotognin.com.br
   */

   header('Content-Type: text/html; charset=utf-8');

   class TheForm
   {
      // Form - Atributos do formulário, utilizado assim que é criado
      public $form_before;
      public $form_after;
      public $form_name;
      public $form_id;
      public $form_action;
      public $form_method;
      public $form_target;
      public $add_to_form; // Adiciona instruções ao criar o formulário
      public $form_is_upload; // bool (Condição específica para Upload)
      // Label
      public $label_id;
      public $label_name; // Será exibido antes do campo
      public $label_add_between; // Código para adicionar entre o label e o campo
      public $label_is_before; // bool - Indica se o label vem antes ou após o campo
      // Field
      public $type; // text, number, password, email, checkbox, radio...
      public $id;
      public $name;
      public $value;
      public $placeholder;
      public $width; // adiciona style="width:[n]px" ao campo
      public $height; // adiciona style="height:[n]px" ao campo
      public $required; // bool
      public $maxlength;
      public $options; // Array específico para select e datalist
      // Html - Propriedades a serem inseridas antes e depois dos campos
      public $before_field;
      public $after_field;
      public $add_to_field;
      // Button
      public $button_type;
      public $button_value;

      private function initialDefaultValues() {
         // Valores iniciais padrão para o formulário
         $this->form_before = '';
         $this->form_after = '';
         $this->form_name = '';
         $this->form_id = '';
         $this->form_action = 'validar.php';
         $this->form_method = 'post';
         $this->form_target = '';
         $this->add_to_form = '';
         $this->form_is_upload = false;
         // Button
         $this->button_type = 'submit';
         $this->button_value = 'Enviar';
      }

      private function defaultValues() {
         // Label
         $this->label_id = '';
         $this->label_name = '';
         $this->label_add_between = '';
         $this->label_is_before = 'true';
         // Field
         $this->type = '';
         $this->id = '';
         $this->name = '';
         $this->value = '';
         $this->placeholder = '';
         $this->width = 0;
         $this->height = 0;
         $this->required = false;
         $this->maxlength = 0;
         $this->options = array();
         // Html
         $this->before_field = '';
         $this->after_field = '';
         $this->add_to_field = '';
      }

      public function __construct() {
         // Set default values
         $this->initialDefaultValues();
         $this->defaultValues();
      }
      
      // Método utilizado para adicionar string´s caso tenham
      // algum valor
      private function addString($string_to_add) {
         if ($string_to_add != '') {
            return $string_to_add;
         } else {
            return '';
         }
      }

      public function openForm() {
         $html = ''; // Inicializar a variável
         
         $html .= $this->addString($this->form_before);

         $html .= '<form action="' . $this->form_action . '" method="' . $this->form_method . '" ';

         if ($this->form_id != '') {
            $html .= ' id="' . $this->form_id . '" ';
         }

         if ($this->form_name != '') {
            $html .= ' name="' . $this->form_name . '" ';
         }
         
         if ($this->form_target != '') {
            $html .= ' target="' . $this->form_target . '" ';
         }
         
         $html .= $this->addString($this->add_to_form);

         if ($this->form_is_upload) {
            $html .= 'enctype="multipart/form-data" ';
         }

         $html .= '>' . PHP_EOL;

         return $html;
      }
      
      private function setLabel() {
         $label = '';
         
         if ($this->label_name != '') {
            $label .= '<label ';

            if ($this->id != '') {
               $label .= 'for="' . $this->id . '" ';
            }

            if ($this->label_id != '') {
               $label .= 'id="' . $this->label_id . '" ';
            }

            $label .= '>' . $this->label_name . '</label>' . PHP_EOL;
         }
         
         return $label;
      }
      
      private function setInput() {
         $input = '';
         
         if ($this->name != '') {
            if ($this->type == 'select') {
               $input .= '<select ';
            } else {
               $input .= '<input ';
            }

            if ($this->type != '') {
               if (($this->type == 'list') || ($this->type == 'select')) {
                  if ($this->type == 'list') {
                     $input .= 'list="' . $this->name . '" ';
                  }
               } else {
                  $input .= 'type="' . $this->type . '" ';
               }
            } 

            if ($this->id != '') {
               $input .= 'id="' . $this->id . '" ';
            }

            if ($this->name != '') {
               $input .= 'name="' . $this->name . '" ';
            }

            if ($this->value != '') {
               $input .= 'value="' . $this->value . '" ';
            }

            if (($this->width > 0) || ($this->height > 0)) {
               $input .= 'style="';

               if ($this->width > 0) {
                  $input .= 'width:' . $this->width . 'px;';
               }
               
               if ($this->height > 0) {
                  $input .= 'height:' . $this->height . 'px;';
               }
               
               $input .= '" ';
            }

            if ($this->placeholder != '') {
               $input .= 'placeholder="' . $this->placeholder . '" ';
            }

            if ($this->required) {
               $input .= 'required ';
            }

            $input .= $this->add_to_field;
            $input .= '>' . PHP_EOL;
            return $input;
         }
      }

      private function setList() {
         $list = '';
         
         $list .= '<datalist id="' . $this->name . '">' . PHP_EOL;
         
         foreach ($this->options as $value) {
            $list .= '<option value="' . $value . '">' . PHP_EOL;
         }
         
         $list .= '</datalist>' . PHP_EOL;
         return $list;
         
      }
      
      private function setSelect() {
         $select = '';
         
         foreach ($this->options as $value => $name) {
            $select .= '<option value="' . $value . '" ';
            if ($value == $this->value) {
               $select .= 'selected';
            }
            $select .= '>' . $name . '</option>' . PHP_EOL;
         }
         
         $select .= '</select>' . PHP_EOL;
         return $select;
      }

      public function getField() {
         $html = '';

         $html .= $this->addString($this->before_field);
         
         if ($this->label_is_before) {
            $html .= $this->setLabel();
            $html .= $this->addString($this->label_add_between);
            $html .= $this->setInput();
         } else {
            $html .= $this->setInput();
            $html .= $this->addString($this->label_add_between);
            $html .= $this->setLabel();
         }
         
         // Se for um select ou datalist, adicionar aqui
         if ($this->type == 'list') {
            $html .= $this->setList();
         }
         
         if ($this->type == 'select') {
            $html .= $this->setSelect();
         }

         $html .= $this->addString($this->after_field);
         $this->defaultValues();
         return $html;
      }

      public function getButton() {
         $html = '';
         
         if ($this->button_type != '') {
            $html .= '<button type="' . $this->button_type . '" ';
         }

         $html .= $this->add_to_field . '>' . $this->button_value;
         $html .= '</button>' . PHP_EOL;

         return $html;
      }

      public function closeForm() {
         $html = '';
         
         $html .= '</form>' . PHP_EOL;
         $html .= $this->addString($this->form_after);
         return $html;
      }
   }
?>