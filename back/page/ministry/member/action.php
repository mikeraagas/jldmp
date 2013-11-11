<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Back_Page_Ministry_Member_Action extends Back_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'JLDMP - Action Member';
	protected $_class = 'ministry-member-action';
	protected $_template = '/ministry/member/action.phtml';
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		$action 	= back()->registry()->get('request', 'variables', 0);
		$ministryId = back()->registry()->get('request', 'variables', 1);

		if (isset($_GET['getMember'])) {
			$id = $_GET['id'];

			$member = $this->_db->search()
				->setTable('member')
				->setColumns('*')
				->filterByMemberId($id)
				->getRow();

			echo json_encode($member);
			exit;
		}

		if (isset($action) && $action == 'update') {
			$id 		= $_POST['id'];
			$firstname 	= $_POST['first_name'];
			$lastname 	= $_POST['last_name'];
			$email 		= $_POST['email'];
			$address 	= $_POST['address'];
			$phone 		= $_POST['phone'];
			$age 		= $_POST['age'];

			$settings = array(
				'member_first' => $firstname,
				'member_last' => $lastname,
				'member_email' => $email,
				'member_address' => $address,
				'member_phone' => $phone,
				'member_age' => $age);

			$filter[] = array('member_id=%s', $id);
			$filter[] = array('member_ministry=%s', $ministryId);
			$this->_db->updateRows('member', $settings, $filter);
			
			header('Location: /ministry/detail/members/'.$ministryId);
			exit();
		}

		if (isset($action) && $action == 'delete') {
			$id = $_GET['id'];

			$filter[] = array('member_id=%s', $id);
			$filter[] = array('member_ministry=%s', $ministryId);
			$this->_db->deleteRows('member', $filter);

			header('Location: /ministry/detail/members/'.$ministryId);
			exit();
		}
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
