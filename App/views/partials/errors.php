<?php if (!empty($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="message bg-red-100 my-3 px-4 py-1 rounded"><?= $error ?></div>
    <?php endforeach; ?>
<?php endif; ?>
