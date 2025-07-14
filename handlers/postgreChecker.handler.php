
<?php
require_once UTILS_PATH . '/envSetter.util.php';

$conn_string = sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s",
    $typeConfig['pgHost'],
    $typeConfig['pgPort'],
    $typeConfig['pgDB'],
    $typeConfig['pgUser'],
    $typeConfig['pgPassword']
);

$dbconn = @pg_connect($conn_string);
if (!$dbconn) {
    echo "❌ Connection Failed: " . pg_last_error() . "  <br>";
    exit();
} else {
    echo "✔️ PostgreSQL Connection  <br>";
    pg_close($dbconn);
}
