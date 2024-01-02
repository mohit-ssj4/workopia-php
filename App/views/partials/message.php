<?php if (!empty($_SESSION['success_message'])): ?>
    <div class="message bg-green-100 p-3 my-3 rounded-lg">
        <?= $_SESSION['success_message'] ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['error_message'])): ?>
    <div class="message bg-red-100 p-3 my-3 rounded-lg">
        <?= $_SESSION['error_message'] ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
