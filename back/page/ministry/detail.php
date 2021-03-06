<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Back_Page_Ministry_Detail extends Back_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Eden';
	protected $_class = 'home';
	protected $_template = '/ministry/detail.phtml';
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		$section = back()->registry()->get('request', 'variables', 0);
		$id = back()->registry()->get('request', 'variables', 1);

		$ministry = $this->_db->search()
			->setTable('ministry')
			->setColumns('*')
			->filterByMinistryId($id)
			->getRow();

		$members = $this->_db->search()
			->setTable('member')
			->setColumns('*')
			->filterByMemberMinistry($id)
			->getRows();

		$events = $this->_db->search()
			->setTable('event')
			->setColumns('*')
			->filterByEventMinistry($id)
			->getRows();

		$this->_body = array(
			'section' 	=> $section,
			'ministry' 	=> $ministry,
			'members' 	=> $members,
			'events' 	=> $events);

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
