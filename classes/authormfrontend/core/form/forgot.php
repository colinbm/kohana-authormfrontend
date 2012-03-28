<?php defined('SYSPATH') or die('No direct script access.');

class AuthOrmFrontend_Core_Form_Forgot extends FormManager {
	
	protected function setup() {
		$this->add_field('username');
		$this->submit_text = 'Send instructions';
	}
	
	public function submit() {
		$success = parent::submit();
		if (!$success) return false;
		
		$values = $this->get_input();
		
		return $this->send_reminder($values['username']);
		
	}
	
	protected function send_reminder($username) {
		$user = ORM::factory('user')->where('username', '=', $username)->find();
		if (!$user->id) return false;
		
		$view = View::factory('authormfrontend/email/forgot.text');
		
		$view->user = $user;
		$view->auth = md5($user->username . $user->email . $user->last_login . $user->updated_at);
		
		mail($user->email, __('Reset Password'), $view->render(), 'From: noreply@' . (preg_replace('/^www\./', '', $_SERVER['SERVER_NAME'])));
		
		return true;
		
		
	}
	
}