Hi <?php echo $user->name; ?>,

Please follow this link to reset your password.

http://<?php echo $_SERVER['SERVER_NAME']; ?><?php echo Route::url('authormfrontend_reset', array('username' => $user->username, 'auth' => $auth)) ?>