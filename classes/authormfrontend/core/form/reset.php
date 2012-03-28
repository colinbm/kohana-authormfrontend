<?php defined('SYSPATH') or die('No direct script access.');

class AuthOrmFrontend_Core_Form_Reset extends FormManager {
	
	protected function setup() {
		$this->add_field('username', array('display_as' => 'hidden'));
		$this->add_field('auth', array('display_as' => 'hidden'));
		$this->add_field('password', array('display_as' => 'password'));
		$this->add_field('password_confirm', array('display_as' => 'password'));
		$this->rule('password_confirm', 'matches', array(':validation', 'password', ':field'));
		$this->submit_text = 'Reset Password';
	}
	
	public function submit() {
		$success = parent::submit();
		if (!$success) return false;
		
		$input = $this->get_input();
		
		$user = ORM::factory('user')->where('username', '=', $input['username'])->find();
		if (!$user->id) return false;
		
		if ($input['auth'] == md5($user->username . $user->email . $user->last_login . $user->updated_at)) {
			
			$user->password = $input['password'];
			$user->save();
			
			return true;
			
		}
		
		return false;
		
	}
	
}