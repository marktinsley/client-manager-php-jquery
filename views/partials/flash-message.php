<?php if (isset($message) && $message): ?>
    <div class="alert alert-<?= $message_type ?>">
        <?= $message ?>
    </div>
<?php endif; ?>
