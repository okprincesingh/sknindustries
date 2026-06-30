<?php
require_once __DIR__ . '/recaptcha-config.php';

function verifyRecaptchaToken($token, $remoteIp = null)
{
    if (empty(RECAPTCHA_SECRET_KEY) || RECAPTCHA_SECRET_KEY === 'YOUR_RECAPTCHA_SECRET_KEY') {
        return [false, 'reCAPTCHA secret key is not configured.'];
    }

    if (empty($token)) {
        return [false, 'Please complete the CAPTCHA challenge.'];
    }

    $payload = [
        'secret' => RECAPTCHA_SECRET_KEY,
        'response' => $token,
    ];

    if (!empty($remoteIp)) {
        $payload['remoteip'] = $remoteIp;
    }

    $opts = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($payload),
            'timeout' => 10,
        ],
    ];

    $context = stream_context_create($opts);
    $response = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
    if ($response === false) {
        return [false, 'Could not verify CAPTCHA. Please try again.'];
    }

    $result = json_decode($response, true);
    if (!is_array($result) || empty($result['success'])) {
        return [false, 'CAPTCHA verification failed.'];
    }

    return [true, null];
}

