<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'TriTrack' ?></title>
    <link rel="stylesheet" href="<?= $appUrl ?? '' ?>/css/layouts/main-layout.css">
    <link rel="stylesheet" href="<?= $appUrl ?? '' ?>/css/components/dashboard.css">
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
    
    <script src="<?= $appUrl ?? '' ?>/js/components/dashboard.js"></script>
</body>
</html>