<?php if (isset($form_success) and $form_success == true): ?>

	<div class="alert-message success">You have successfully registered.</div>

<?php elseif (isset($form_success) and $form_success == false): ?>

	<div class="alert-message error">Your profile could not be updated. Please check for errors below.</div>
	<?php echo $form->render(); ?>

<?php else: ?>

	<?php echo $form->render(); ?>

<?php endif; ?>



