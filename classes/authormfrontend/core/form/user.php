<?php

class AuthOrmFrontend_Core_Form_User extends FormManager {
	
	protected $model = 'user';
	
	protected $exclude_fields = array('logins', 'last_login');
	
	protected function setup() {
		$this->move_field('password', 'end');
		$this->add_field('password_confirm', array('display_as' => 'password'), 'after', 'password');
		$this->fields['password']['display_as'] = 'password';
		$this->rule('password', 'min_length', array(':value', 4));
		$this->rule('password_confirm', 'matches', array(':validation', 'password', ':field'));
		$this->set_value('password', '');
		$this->set_value('password_confirm', '');
		$this->remove_field('roles');
	}
	
	public function submit() {
		
		$success = parent::submit();
		if ($success) {
			if ($this->get_input('password') == '') {
				$input = $this->get_input();
				unset($input['password']);
				$this->object->reload();
				foreach ($input as $k => $v) {
					$this->set_value($k, $v);
				}
			}
			$this->save_object();
		}
		return $success;
		
	}
	
}