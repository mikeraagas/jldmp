<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Back_Page_Ministry_List extends Back_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Eden';
	protected $_class = 'ministry';
	protected $_template = '/ministry/list.phtml';
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		$ministries = back()->database()->getRows('ministry');

		if (isset($_GET['action']) && $_GET['action'] == 'remove') {
			$id 	= $_GET['id'];
			$action = $_GET['action'];

			$filter[] = array('ministry_id=%s', $id);

			$this->_db->deleteRows('ministry', $filter);
			header('Location: /ministry/list');
			exit;
		}

		$this->_body = array('ministries' => $ministries);

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
