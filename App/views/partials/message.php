<?php

use Framework\Session;

$successMessage = Session::getFlashMessage('success_message');
$errorMessage = Session::getFlashMessage('error_message');
?>

<?php if (!empty($successMessage)): ?>
    <div class="message bg-green-100 p-3 my-3 rounded-lg">
        <?= $successMessage ?>
    </div>
<?php endif; ?>
<?php if (!empty($errorMessage)): ?>
    <div class="message bg-red-100 p-3 my-3 rounded-lg">
        <?= $errorMessage ?>
    </div>
<?php endif; ?>
