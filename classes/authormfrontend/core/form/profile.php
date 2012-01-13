<?php defined('SYSPATH') or die('No direct script access.');

class AuthOrmFrontend_Core_Form_Profile extends Form_User {
	
	protected function setup() {
		parent::setup();
		$this->remove_field('username');
	}
	
	public function submit() {
		// Ensure current user has permissions to edlt
		$auth = Auth::instance();
		$user = $auth->get_user();
		if ($user->id != $this->object->id) {
			return false;
		}
		
		return parent::submit();
		
	}
	
}