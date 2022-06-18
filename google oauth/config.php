<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ataglance');
define('DB_USER_TBL', 'users');

// Google API configuration
define('GOOGLE_CLIENT_ID', '737287686501-oolag5jjlh5iggre0a80vov67gj3a1eh.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URL', 'http://localhost/ataglance');

// Start session
if (!session_id()) {
    session_start();
}

// Include Google API client library
require_once 'vendor/autoload.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to ataglance.com');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);
$gClient->addScope('https://mail.google.com/');

$google_oauthV2 = new Google\Service\Oauth2($gClient);
