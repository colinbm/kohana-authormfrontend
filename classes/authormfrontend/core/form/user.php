<?php

class AuthOrmFrontend_Core_Form_User extends FormManager {
	
	protected $model = 'user';
	
	protected $exclude_fields = array('logins', 'last_login');
	
	protected function setup() {
		$this->add_field('password_confirm', array('display_as' => 'password'), 'after', 'password');
		$this->fields['password']['display_as'] = 'password';
		$this->rule('password', 'min_length', array(':value', 4));
		$this->rule('password_confirm', 'matches', array(':validation', 'password', ':field'));
		$this->set_value('password', '');
		$this->set_value('password_confirm', '');
	}
	
	public function submit() {
		
		$success = parent::submit();
		
		if ($success) {
			$this->save_object();
		}
		return $success;
		
	}
	
}