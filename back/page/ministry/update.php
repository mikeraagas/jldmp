<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Back_Page_Ministry_Update extends Back_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Eden';
	protected $_class = 'ministry';
	protected $_template = '/ministry/update.phtml';
	protected $_message = '';

	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		$id = back()->registry()->get('request', 'variables', 0);

		$ministry = $this->_db->search()
			->setTable('ministry')
			->setColumns('*')
			->filterByMinistryId($id)
			->getRow();

		if (isset($_POST['update'])) {
			$id 		 = $_POST['id'];
			$name 		 = $_POST['name'];
			$description = $_POST['description'];

			$settings = array(
				'ministry_name' 	=> $name,
				'ministry_excerpt' 	=> $description);

			$filter[] = array('ministry_id=%s', $id);

			$this->_db->updateRows('ministry', $settings, $filter);
			header('Location: /ministry/update/'.$id);
			exit;
		}

		$this->_body = array('ministry' => $ministry);

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
