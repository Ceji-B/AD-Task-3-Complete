<?php
function handleError($errorCode, $message = '') {
    http_response_code($errorCode);
    
    switch ($errorCode) {
        case 404:
            include ERRORS_PATH . '/404.error.php';
            break;
        case 500:
            include ERRORS_PATH . '/500.error.php';
            break;
        default:
            include ERRORS_PATH . '/general.error.php';
            break;
    }
    exit;
}

function handle404() {
    handleError(404);
}

function handle500($message = '') {
    handleError(500, $message);
}
?>
