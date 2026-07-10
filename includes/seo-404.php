<?php
function renderSeoNotFound()
{
    if (!headers_sent()) {
        http_response_code(404);
    }

    require __DIR__ . '/../404.php';
    exit;
}
