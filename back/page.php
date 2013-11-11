<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * The base class for any class that defines a view.
 * A view controls how templates are loaded as well as 
 * being the final point where data manipulation can occur.
 *
 * @package    Eden
 */
abstract class Back_Page extends Eden_Class {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_meta	= array();
	protected $_head 	= array();
	protected $_body 	= array();
	protected $_foot 	= array();
	
	protected $_db 			= NULL;
	protected $_title 		= NULL;
	protected $_class 		= NULL;
	protected $_template 	= NULL;
	
	/* Private Properties
	-------------------------------*/
	/* Get
	-------------------------------*/
	/* Magic
	-------------------------------*/
	public function __toString() {
		try {
			$output = $this->render();
		} catch(Exception $e) {
			Eden_Error_Event::i()->exceptionHandler($e);
			return '';
		}
		
		if(is_null($output)) {
			return '';
		}
		
		return $output;
	}

	public function __construct() {
		$this->_db = back()->getDatabase();
	}

	/* Public Methods
	-------------------------------*/
	/**
	 * Returns a string rendered version of the output
	 *
	 * @return string
	 */
	abstract public function render();
	
	/* Protected Methods
	-------------------------------*/
	protected function _page() {
		$this->_head['page'] = $this->_class;
		$tpl = back()->path('template');
		$page = back()->path('page');

		if ($this->_class == 'back-page-login') {
			if (isset($_SESSION['admin_id'])) {
				header('Location: /index');
				exit;
			}

			$body = back()->trigger('body')->template($tpl.$this->_template, $this->_body);
		} else {
			if (!isset($_SESSION['admin_id'])) {
				header('Location: /login');
				exit;
			}

			$head = back()->trigger('head')->template($tpl.'/_head.phtml', $this->_head);
			$body = back()->trigger('body')->template($tpl.$this->_template, $this->_body);
			$foot = back()->trigger('foot')->template($tpl.'/_foot.phtml', $this->_foot);
		}
		
		//page
		return back()->template($tpl.'/_page.phtml', array(
			'meta' 			=> $this->_meta,
			'title'			=> $this->_title,
			'class'			=> $this->_class,
			'head'			=> isset($head) ? $head : null,
			'body'			=> $body,
			'foot'			=> isset($foot) ? $foot : null));
	}
	
	/* Private Methods
	-------------------------------*/
}