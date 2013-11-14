<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Back_Page_Ministry_Event_Create extends Back_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'JLDMP - Create Updates';
	protected $_class = 'ministry-event-create';
	protected $_template = '/ministry/event/create.phtml';
	
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

		if (isset($_POST['create_event'])) {
			$event = array(
				'event_ministry' => $id,
				'event_title' 	 => $_POST['title'],
				'event_detail' 	 => $_POST['detail'],
				'event_active' 	 => $_POST['active'],
				'event_created'  => time(),
				'event_updated'  => time());

			$this->_db->model($event)->save('event');

			header('Location: /ministry/detail/events/'.$id);
			exit;
		}

		$this->_body = array(
			'ministry' 	=> $ministry,
			'section' 	=> 'events');

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
