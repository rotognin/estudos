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
      public $is_upload; // bool
      public $label_id;
      public $label_name;
      public $input_type; // text, number, password, email...
      public $input_id;
      public $input_name;
      public $input_value;
      public $input_placeholder;
      public $input_width; // add style="width:[n]px" to field
      public $input_required; // bool
      public $button_type;
      public $button_value;

      public function defaultValues() {
         $this->is_upload = false;
         $this->label_id = '';
         $this->label_name = '';
         $this->input_type = '';
         $this->input_id = '';
         $this->input_name = '';
         $this->input_value = '';
         $this->input_placeholder = '';
         $this->input_width = '';
         $this->input_required = false;
         $this->button_type = 'submit';
         $this->button_value = 'Submit';
      }

      public function __construct() {
         // Set default values
         $this->defaultValues();
      }

      public function openForm($form_id = '', $form_name = '', $form_add = '', $action = '', $method = 'POST') {
         $html = '<form action="' . $action . '" method="' . $method . '" ';

         if ($form_id != '') {
            $html .= ' id="' . $form_id . '" ';
         }

         if ($form_name != '') {
            $html .= ' name="' . $form_name . '" ';
         }

         $html .= $form_add . ' ';

         if ($this->is_upload) {
            $html .= 'enctype="multipart/form-data" ';
         }

         $html .= '>' . PHP_EOL;

         return $html;
      }

      public function getField($before_field = '', $after_field = '', $add_to_field = '', $add_html = '') {
         $html = '';
         $make_input = true;

         $html .= $before_field;

         if ($this->label_name != '') {
            $html .= '<label ';

            if ($this->input_name != '') {
               $html .= 'for="' . $this->input_name . '" ';
            }

            if ($this->label_id != '') {
               $html .= 'id="' . $this->label_id . '" ';
            }

            $html .= '>';

            if (strtolower($this->input_type) == 'checkbox' ||
                strtolower($this->input_type) == 'radio') {

               $make_input = false;
               $html .= '<input type="' . $this->input_type . '" ';

               if ($this->input_name != '') {
                  $html .= 'name="' . $this->input_name . '" ';
               }

               if ($this->input_value != '') {
                  $html .= 'value="' . $this->input_value . '" ';
               }

               if ($this->input_id != '') {
                  $html .= 'id="' . $this->input_id . '" ';
               }

               $html .= '>';
            }

            $html .= $this->label_name . '</label>' . PHP_EOL;
         }

         if ($this->input_name != '' && $make_input) {
            $html .= '<input ';

            if ($this->input_type != '') {
               $html .= 'type="' . $this->input_type . '" ';
            }

            if ($this->input_id != '') {
               $html .= 'id="' . $this->input_id . '" ';
            }

            if ($this->input_name != '') {
               $html .= 'name="' . $this->input_name . '" ';
            }

            if ($this->input_value != '') {
               $html .= 'value="' . $this->input_value . '" ';
            }

            if ($this->input_width != '') {
               $html .= 'style="width:' . $this->input_width . 'px" ';
            }

            if ($this->input_placeholder != '') {
               $html .= 'placeholder="' . $this->input_placeholder . '" ';
            }

            if ($this->input_required) {
               $html .= 'required ';
            }

            $html .= $add_to_field;
            $html .= '>';
         }

         $html .= $after_field . PHP_EOL;
         $html .= $add_html;

         $this->defaultValues();
         return $html;
      }

      public function getButton($add_to_button = '') {
         if ($this->button_type != '') {
            $html = '<button type="' . $this->button_type . '" ';

            $html .= $add_to_button . '>' . $this->button_value;
            $html .= '</button>' . PHP_EOL;

            return $html;
         }
      }

      public function makeSelect($before_field = '', $add_to_field = '') {
         $html = '';

         $html .= $before_field;

         if ($this->label_name != '') {
             $html .= '<label ';

             if ($this->input_name != '') {
                 $html .= 'name="' . $this->input_name . '" ';
             }

             $html .= '>';
         }

         $html = '<select ';

         if ($this->input_name != '') {
             $html .= 'name="' . $this->input_name . '" ';
         }

         if ($this->input_id != '') {
             $html .= 'id="' . $this->input_id . '" ';
         }

         $html .= $add_to_field . '>' . PHP_EOL;
         return $html;
      }

      public function addOption($options = array(), $default_value = '', $after_field = '') {
         $html = '';

         if (count($options > 0)) {
            foreach ($options as $value => $caption) {
               $html .= '<option value="' . $value . '" ';

               if ($default_value != '') {
                  $html .= 'selected="' . $default_value . '" ';
               }

               $html .= '>' . $caption . '</option>' . PHP_EOL;
            }

            $html .= '</select>' . PHP_EOL;

            if ($after_field != '') {
                $html .= $after_field;
            }

            $this->defaultValues();
            return $html;
         }
      }

      public function closeForm() {
         $html = '</form>';
         return $html;
      }
   }
?>