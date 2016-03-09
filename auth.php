<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$fb = new Facebook\Facebook([
	'app_id' => getenv('APP_ID'),
	'app_secret' => getenv('APP_SECRET'),
	'default_graph_version' => 'v2.5',
]);

$linkData = [
	'message' => 'Hello Facebook SDK',
];

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://toyamarinyon.agex.local:8080/callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
