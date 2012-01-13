<?php defined('SYSPATH') or die('No direct script access.');

class AuthOrmFrontend_Core_Form_Login extends FormManager {
	
	protected function setup() {
		$this->add_field('username');
		$this->add_field('password', array('display_as' => 'password'));
		$this->rule('username', 'not_empty');
		$this->rule('password', 'not_empty');
	}
	
	public function submit() {
		$success = parent::submit();
		if (!$success) return false;
		
		$values = $this->get_input();
		$auth = Auth::instance();
		$success = $auth->login($values['username'], $values['password']);
		if (!$success) $this->submit_status = self::SUBMIT_STATUS_FAIL;
		$this->fields['password']['value'] = '';
		
		return $success;
	}
	
}