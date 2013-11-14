<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Back_Page_Ministry_Member_Create extends Back_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'JLDMP - Create Member';
	protected $_class = 'ministry-member-create';
	protected $_template = '/ministry/member/create.phtml';
	
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

		if (isset($_POST['create_member'])) {
			$member = array(
				'member_ministry' 	=> $id,
				'member_first' 		=> $_POST['first_name'],
				'member_last' 		=> $_POST['last_name'],
				'member_email' 		=> $_POST['email'],
				'member_address' 	=> $_POST['address'],
				'member_phone' 		=> $_POST['phone'],
				'member_age' 		=> $_POST['age']);

			$this->_db->model($member)->save('member');

			header('Location: /ministry/detail/members/'.$id);
			exit;
		}

		$this->_body = array(
			'ministry' 	=> $ministry,
			'section' 	=> 'members');

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
