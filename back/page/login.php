<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Back_Page_Login extends Back_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Eden';
	protected $_class = 'back-page-login';
	protected $_template = '/login.phtml';
	protected $_message;
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		if (isset($_POST['login'])) {
			$email 		= $_POST['email'];
			$password 	= $_POST['password'];
			$valid 		= true;

			$adminInfo = back()->database()
				->search('admin')
				->setColumns('*')
				->filterByAdminEmail($email)
				->filterByAdminPassword(md5($password))
				->getRow();

			// if ($adminInfo['admin_type'] != 1) {
			// 	$valid = false;
			// 	$this->_message = 'You don\'t have permission to access';
			// }

			if (empty($adminInfo)) {
				$valid = false;
				$this->_message = 'Incorrect email or password';
			}

			if (md5($password) !== $adminInfo['admin_password']) {
				$valid = false;
				$this->_message = 'Incorrect Password';
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$valid = false;
				$this->_message = 'Not Valid Email';
			}

			if ((isset($email) && empty($email)) || (isset($password) && empty($password))) {
				$valid = false;
				$this->_message = 'All fields are required';
			}

			if ($valid) {
				$_SESSION['admin_id'] 	= $adminInfo['admin_id'];
				$_SESSION['admin_name'] = $adminInfo['admin_name'];
				header('Location: /index');
				exit;
			}

			$this->_body = array(
				'message' 	=> $this->_message,
				'email' 	=> $email);
		}

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
