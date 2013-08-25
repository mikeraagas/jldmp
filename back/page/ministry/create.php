<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Back_Page_Ministry_Create extends Back_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Eden';
	protected $_class = 'home';
	protected $_template = '/ministry/create.phtml';
	protected $_message = '';

	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		if (isset($_POST['create'])) {
			$name 	 = $_POST['name'];
			$excerpt = $_POST['description'];

			$valid = true;
			$requiredValues = array('name', 'description');
			foreach ($requiredValues as $value) {
				if (empty($_POST[$value])) {
					$valid 			= false;
					$this->_message = 'All fields are required';
				}
			}

			if ($valid) {
				$date = date("Y-m-d H:i:s");

				$settings = array(
					'ministry_name' 	=> $name,
					'ministry_excerpt' 	=> $excerpt,
					'ministry_created' 	=> $date,
					'ministry_updated' 	=> $date);

				back()->database()->insertRow('ministry', $settings);
				header('Location: /ministry/upload/logo');
				exit;
			}

			$this->_body = array(
				'name' 			=> $name,
				'description' 	=> $excerpt,
				'message' 		=> $this->_message); 
		}

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
