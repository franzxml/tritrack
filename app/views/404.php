<?php
$appUrl = 'http://tritrack.test';
ob_start();
?>

<div class="error-container">
    <div class="error-content">
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Page Not Found</h2>
        <p class="error-message">The page you're looking for doesn't exist or has been moved.</p>
        <a href="<?= $appUrl ?>" class="btn-home">Go to Dashboard</a>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = '404 - Page Not Found';
$page = 'error';
include __DIR__ . '/layouts/main-layout.php';
?>