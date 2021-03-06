<?php defined('SYSPATH') or die('No direct access allowed.');

class AuthOrmFrontend_Core_Controller_AuthOrmFrontend extends Controller_Template {
	
	public function action_login() {

		$form = new Form_Login();

		$view = View::factory('authormfrontend/login');

		if ($form->is_submitted()) {
			if ($form->submit()) {
				Flash::success(__('You are now logged in.'));
				if ($this->request->param('redirect_path')) {
					$this->request->redirect($this->request->param('redirect_path'));
				} else {
					$this->request->redirect(Route::get('default')->uri());
				}
				$this->template->user = Auth::instance()->get_user();
			} else {
				Flash::error(__('Your username or password were not recognised.'));
			}
		}

		$view->form = $form;

		$this->template->content = $view->render();

	}

	public function action_logout() {

		$auth = Auth::instance();
		$auth->logout(false, true);
		Flash::success(__('You have successfully logged out.'));
		$this->request->redirect(Route::get('default')->uri());

	}

	public function action_profile() {

		if (Auth::instance()->logged_in() === false) {
			$this->request->redirect(Route::get('authormfrontend_login')->uri(array('redirect_path' => Route::get('authormfrontend_profile')->uri())));
		}

		$view = View::factory('authormfrontend/profile');

		$auth = Auth::instance();
		/* @var $user Model_User */
		$user = $auth->get_user();

		$form = new Form_Profile($user->id);

		if ($form->is_submitted()) {
			if ($form->submit()) {
				Flash::success(__('Your profile has been successfully updated.'));
				$this->template->user = Auth::instance()->get_user();
			} else {
				Flash::error(__('Your profile could not be updated. Please check for errors below.'));
			}
		}

		$view->form = $form;

		$this->template->content = $view->render();

	}

	public function action_register() {

		$view = View::factory('authormfrontend/register');

		$form = new Form_Register();

		if ($form->is_submitted()) {
			if ($user = $form->submit()) {
				Flash::success(__('You have successfully registered.'));
				$auth = Auth::instance();
				$values = $form->get_input();
				if (($auth->login($values['username'], $values['password']))) {
					$this->template->user = $auth->get_user();
				}
				$this->request->redirect(Route::get('default')->uri());
			} else {
				Flash::error(__('Your details were incomplete. Please check for errors below.'));
			}
		}

		$view->form = $form;

		$this->template->content = $view->render();

	}
	
	public function action_forgot() {
		
		$view = View::factory('authormfrontend/forgot');
		
		$form = new Form_Forgot();
		
		if ($form->is_submitted()) {
			if ($form->submit()) {
				Flash::info("Please check your email for further instructions on resetting your password.");
				$this->request->redirect(Route::url('default'));
			} else {
				Flash::error('No user found with that username.');
			}
		}
		
		$view->form = $form;
		
		$this->template->content = $view->render();
		
	}
	
	public function action_reset() {
		
		$view = View::factory('authormfrontend/reset');
		
		$form = new Form_Reset();
		
		if ($form->is_submitted()) {
			if ($form->submit()) {
				Flash::success("Your password has been reset. You may now login.");
				$this->request->redirect(Route::url('authormfrontend_login'));
			} else {
				Flash::error("Your password could not be reset.");
			}
		}
		
		
		$form->set_value('username', $this->request->param('username'));
		$form->set_value('auth', $this->request->param('auth'));
		
		$view->form = $form;
		
		$this->template->content = $view->render();
		
	}
	

}