
<?php
require_once __DIR__ . '/../bootstrap.php';
require_once UTILS_PATH . '/envSetter.util.php';


try {
    $mongoConnStr = sprintf(
        "mongodb://%s:%s@%s:%s/%s?authSource=admin",
        $typeConfig['mongoUser'],
        $typeConfig['mongoPassword'],
        $typeConfig['mongoHost'],
        $typeConfig['mongoPort'],
        $typeConfig['mongoDB']
    );
    $mongo = new MongoDB\Driver\Manager($mongoConnStr);
    $command = new MongoDB\Driver\Command(["ping" => 1]);
    $mongo->executeCommand("admin", $command);
    echo "✅ Connected to MongoDB successfully.  <br>";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "❌ MongoDB connection failed: " . $e->getMessage() . "  <br>";
}
