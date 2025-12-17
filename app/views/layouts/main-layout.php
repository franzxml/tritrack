<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'TriTrack' ?></title>
    <link rel="stylesheet" href="<?= $appUrl ?? '' ?>/css/layouts/main-layout.css">
    <link rel="stylesheet" href="<?= $appUrl ?? '' ?>/css/components/modal.css">
    <?php if (isset($page) && $page === 'statistics'): ?>
    <link rel="stylesheet" href="<?= $appUrl ?? '' ?>/css/components/stats.css">
    <?php elseif (isset($page) && $page === 'settings'): ?>
    <link rel="stylesheet" href="<?= $appUrl ?? '' ?>/css/components/settings.css">
    <?php elseif (isset($page) && $page === 'history'): ?>
    <link rel="stylesheet" href="<?= $appUrl ?? '' ?>/css/components/history.css">
    <?php else: ?>
    <link rel="stylesheet" href="<?= $appUrl ?? '' ?>/css/components/dashboard.css">
    <?php endif; ?>
</head>
<body>
    <header class="app-header">
        <h1 class="app-title">TriTrack</h1>
        <p class="app-subtitle">Daily Activity Tracker</p>
    </header>
    
    <main class="app-main">
        <?= $content ?? '' ?>
    </main>
    
    <footer class="app-footer">
        <p>&copy; 2024 TriTrack by franzxml</p>
    </footer>
    
    <script src="<?= $appUrl ?? '' ?>/js/utils/timer-helper.js"></script>
    <script src="<?= $appUrl ?? '' ?>/js/utils/storage-helper.js"></script>
    <script src="<?= $appUrl ?? '' ?>/js/utils/api-helper.js"></script>
    <script src="<?= $appUrl ?? '' ?>/js/utils/notification-helper.js"></script>
    <script src="<?= $appUrl ?? '' ?>/js/components/modal.js"></script>
    <?php if (isset($page) && $page === 'statistics'): ?>
    <script src="<?= $appUrl ?? '' ?>/js/components/stats.js"></script>
    <?php elseif (isset($page) && $page === 'settings'): ?>
    <script src="<?= $appUrl ?? '' ?>/js/components/settings.js"></script>
    <?php elseif (isset($page) && $page === 'history'): ?>
    <script src="<?= $appUrl ?? '' ?>/js/components/history.js"></script>
    <?php else: ?>
    <script src="<?= $appUrl ?? '' ?>/js/components/dashboard.js"></script>
    <?php endif; ?>
</body>
</html>