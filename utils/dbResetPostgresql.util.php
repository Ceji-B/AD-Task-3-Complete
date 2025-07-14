<?php
declare(strict_types=1);

// 1) Composer autoload
require_once 'vendor/autoload.php';

// 2) Composer bootstrap
require_once 'bootstrap.php';

// 3) envSetter
require_once UTILS_PATH . '/envSetter.util.php';

$host = $typeConfig['pgHost'];
$port = $typeConfig['pgPort'];
$username = $typeConfig['pgUser'];
$password = $typeConfig['pgPassword'];
$dbname = $typeConfig['pgDB'];

// Connect to PostgreSQL
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// Truncate tables (if they exist)
echo "Truncating tables…\n";
foreach (["project_users", "tasks", "projects", "users"] as $table) {
    try {
        $pdo->exec("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
    } catch (Exception $e) {
        echo "Warning: Could not truncate table {$table}: " . $e->getMessage() . "\n";
    }
}

// Apply schema from model files
$models = [
    'users.model.sql',
    'projects.model.sql',
    'project_users.model.sql',
    'tasks.model.sql',
];

foreach ($models as $model) {
    $path = BASE_PATH . "/database/" . $model;
    echo "Applying schema from database/{$model}…\n";
    $sql = file_get_contents($path);
    if ($sql === false) {
        throw new RuntimeException("Could not read database/{$model}");
    } else {
        echo "Creation Success from the database/{$model}\n";
    }
    $pdo->exec($sql);
}

echo "✅ PostgreSQL reset complete!\n";
