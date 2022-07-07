<?php
require 'vendor/autoload.php';
use Cumulio\Cumulio;

header('Content-Type: application/json');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$client = Cumulio::initialize($_ENV['CUMUL_KEY'], $_ENV['CUMUL_TOKEN'], $_ENV['API_URL']);

$authorization = $client->create('authorization', array(
  'integration_id' => $_ENV['INTEGRATION_ID'],
  'type' => 'sso',
  'expiry' => '24 hours',
  'inactivity_interval' => '10 minutes',
  'username' => $_ENV['USER_USERNAME'],
  'name' => $_ENV['USER_NAME'],
  'email' => $_ENV['USER_EMAIL'],
  'suborganization' => $_ENV['USER_SUBORGANIZATION'],
  'role' => 'viewer'
));

$authResponse = array(
  'status' => 'success',
  'key' => $authorization['id'],
  'token' => $authorization['token']
);

echo json_encode($authResponse, JSON_PRETTY_PRINT)
?>