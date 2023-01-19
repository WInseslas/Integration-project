<?php
	
	namespace Core\Processing;
	 /**
	  * Processing
	  */
	 class Processing{
	 	
	 	/**
	 	 * @method checkTextarea
	 	 * @param data
	 	 * @return string
	 	 **/

		public function checkTextarea(string $data) : string{
			$data = stripslashes($data);
			$data = strip_tags($data);
			$data = nl2br($data);
			$data = trim($data);
			return $data;
		}


		/**
	 	 * @method input
	 	 * @param data
	 	 * @return string
	 	 **/

		public function checkInput(string $data) : string{
			$data = trim($data);
			$data = strip_tags($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}	
	 }