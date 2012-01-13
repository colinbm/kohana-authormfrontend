<?php defined('SYSPATH') or die('No direct access allowed.');

class AuthOrmFrontend_Core_Controller_AuthOrmFrontend extends Controller_Template {
	
	public function action_login() {

		$form = new Form_Login();

		$view = View::factory('login');

		if ($form->is_submitted()) {
			$success = $form->submit();
			if ($success) {
				if ($this->request->param('redirect_path')) {
					$this->request->redirect($this->request->param('redirect_path'));
				}
				$this->template->user = Auth::instance()->get_user();
			}
		}

		$view->form = $form;

		$this->template->content = $view->render();

	}

	public function action_logout() {

		$auth = Auth_ORM::instance();
		$auth->logout(true, true);

		$this->template->title = I18n::get('Logout');
		$view = View::factory('logout');
		$this->template->content = $view->render();
		$this->template->user = false;

	}

	public function action_profile() {

		if (Auth_ORM::instance()->logged_in() === false) {
			$this->request->redirect(Route::get('authormfrontend_login')->uri(array('redirect_path' => Route::get('authormfrontend_profile')->uri())));
		}

		$view = View::factory('profile');

		$auth = Auth_ORM::instance();
		/* @var $user Model_User */
		$user = $auth->get_user();

		$form = new Form_Profile($user->id);

		if ($form->is_submitted()) {
			$success = $form->submit();
			if ($success) {
				$view->form_success = true;
				$this->template->user = Auth_ORM::instance()->get_user();
			} else {
				$view->form_success = false;
			}
		}

		$view->form = $form;

		$this->template->content = $view->render();

	}

	public function action_register() {

		$view = View::factory('register');

		$form = new Form_Register();

		if ($form->is_submitted()) {
			$success = $form->submit();
			if ($user = $success) {
				$view->form_success = true;
				$auth = Auth::instance();
				$values = $form->get_input();
				if (($auth->login($values['username'], $values['password']))) {
					$this->template->user = $auth->get_user();
				}
			} else {
				$view->form_success = false;
			}
		}

		$view->form = $form;

		$this->template->content = $view->render();

	}

}