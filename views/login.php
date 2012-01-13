<?php if ($form->is_submitted() && $form->submit_status() == FormManager::SUBMIT_STATUS_FAIL): ?>

	<div class="alert-message error">Your username or password were not recognised.</div>
	<?php echo $form->render(); ?>

<?php elseif ($form->is_submitted() && $form->submit_status() == FormManager::SUBMIT_STATUS_SUCCESS): ?>

	<div class="alert-message success">You are now logged in.</div>
	
<?php else: ?>

	<?php echo $form->render(); ?>

<?php endif; ?>
