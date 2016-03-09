<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$fb = new Facebook\Facebook([
	'app_id' => getenv('APP_ID'),
	'app_secret' => getenv('APP_SECRET'),
	'default_graph_version' => 'v2.2',
]);

$linkData = [
	'message' => 'Hello Facebook SDK',
];

try {
	// Returns a `Facebook\FacebookResponse` object
	$response = $fb->post('/me/feed', $linkData, getenv('ACCESS_TOKEN'));
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

$graphNode = $response->getGraphNode();

echo 'Posted with id: ' . $graphNode['id'];

?>
