<?php
	namespace Core\HTML;
	
	/**
	 * Class Form 	: 	classe generatrice de formulaires
	 */

	class Form{
		
		/**
		 * @method surround
		 * @param string html 	: 	l'element a formater
		 * @return string
		 */

		private function surround($html) : string{
			return "<div class=\"form-group\" >{$html}</div>";
		}

		/**
		 * @method input
		 * @param string for 	: 	l'id
		 * @param string type 	: 	le type de champs
		 * @param string name 	: 	le name 
		 * @param string value 	:	la valeur par defaut
		 * @return string
		 */

		public function input($for, $name, $type="text", $value = null) : string{
			$label = "<label for=\"{$for}\">".ucfirst($name)."</label>";
			$input = "<input type=\"{$type}\" value=\"{$value}\" name=\"{$for}\" id=\"{$for}\" class=\"form-control\" />";
			if (is_null($value)) {
				$input = "<input type=\"{$type}\" required='required' name=\"{$for}\" id=\"{$for}\" class=\"form-control\" />";
			}
			return $this->surround($label.$input);
		}

		/**
		 * @method textarea
		 * @param string for 	: 	l'id
		 * @param string name 	: 	le name 
		 * @param string value 	:	le contenue
		 * @return string
		 */

		public function textarea($for, $name, $value = null, $placeholder = null, $required = null) : string{
			$label = "<label for=\"{$for}\">".ucfirst($name)."</label>";
			$textarea = "<textarea name=\"{$for}\" id=\"{$for}\" class=\"form-control\"></textarea>";
			if (!is_null($value)) {
				$textarea = "<textarea name=\"{$for}\" id=\"{$for}\" class=\"form-control\">".$value."</textarea>";
			} elseif (!is_null($placeholder)) {
				$textarea = "<textarea placeholder=\"{$placeholder}\" name=\"{$for}\" id=\"{$for}\" class=\"form-control\"></textarea>";
			} elseif (!is_null($required)) {
				
			}

			return $this->surround($label.$textarea);
		}

		/**
		 * @method select
		 * @param string name 	: 	le name 
		 * @param string label 	: 	le label
		 * @param string option :	les options
		 * @return string
		 */

		public function select($name, $label, $options, $selected = null) : string{
			$label = "<label for=\"{$name}\">".ucfirst($label)."</label>";
			$select = "<select name=\"{$name}\" id=\"{$name}\" class=\"form-control\">";
			foreach ($options as $key => $value) {
				$attribute = "";
				if (!is_null($selected) && $value == $selected) {
					$attribute = "selected";
				}
				
				if ($name === "sexe" || $name === "actif") {
					$select .= "<option value=\"{$key}\" {$attribute}>{$value}</option>";
				} else {
					$select .= "<option value=\"{$key}\" {$attribute}>{$value}</option>";
				}
			}

			$select .= "</select>";
			return $this->surround($label.$select);
		}

		/**
		 * @method checkbox
		 * @param string class 	
		 * @param string name 	
		 * @param string type 
		 * @param string value 	
		 * @param string texte 	
		 * @return string
		 */

		public function checkbox($class, $name, $type="checkbox", $value = null, $texte) : string{
			$checkbox = "<div class=\"{$class}\">
							<label>
					            <input type=\"{$type}\" name=\"{$name}\" value=\"{$value}\">{$texte}
					          </label>
							</div>
						";

			return $checkbox;
		}

		/**
		 * @method message
		 * @param string page 	
		 * @param string name 	
		 * @param string class	
		 * @param string message 	
		 * @return string
		 */

		public function message($name, $page, $message = null, $class = "text-default") : string{
			if (is_null($message)) {
				return "<div><a  class=\"{$class}\" href=\"{$page}\">{$name}</a></div>";
			}
			return  "<div>{$message} <a  class=\"{$class}\" href=\"{$page}\">{$name}</a></div>";
		}	

		/**
		 * @method button
		 * @param string type 	: 	le type de bouton
		 * @param string class 	: 	la class css ou bootstrap
		 * @param string name 	: 	le nom du bouton
		 * @return string
		 */

		public function button($type, $class, $value, $name = null, $function = null) : string{
			if (!is_null($function)) {
				return "<br/><button type=\"{$type}\" name=\"{$name}\" onclick=\"{$function}\" class=\"{$class}\">${value}</button>";
			}
			return "<br/><button type=\"{$type}\" name=\"{$name}\" class=\"{$class}\">${value}</button>";
		}
	}