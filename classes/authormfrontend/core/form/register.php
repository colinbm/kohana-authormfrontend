<?php defined('SYSPATH') or die('No direct script access.');

class AuthOrmFrontend_Core_Form_Register extends Form_User {
	
	protected function setup() {
		parent::setup();
		$this->rule('password', 'not_empty');
		$this->submit_text = 'Register';
	}
	
	public function submit() {
		$success = parent::submit();
		if ($success) {
			$this->object->add('roles', array(1));
			return true;
		}
		return false;
	}
	
}