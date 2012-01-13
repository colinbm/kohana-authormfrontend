<?php if ($form->is_submitted() && $form->submit_status() == $form::SUBMIT_STATUS_FAIL): ?>

	<div class="alert-message error">Your profile could not be updated. Please check for errors below.</div>

<?php elseif ($form->is_submitted() && $form->submit_status() == FormManager::SUBMIT_STATUS_SUCCESS): ?>

	<div class="alert-message success">Your profile has been successfully updated.</div>

<?php endif; ?>

<?php echo $form->render(); ?>