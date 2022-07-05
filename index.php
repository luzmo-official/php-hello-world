<?php
require 'vendor/autoload.php';
use Cumulio\Cumulio;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = Cumulio::initialize($_ENV['CUMUL_KEY'], $_ENV['CUMUL_TOKEN'], 'https://api.cumul.io');

$authorization = $client->create('authorization', array(
  'integration_id' => $_ENV['INTEGRATION_ID'],
  'type' => 'sso',
  'expiry' => '24 hours',
  'inactivity_interval' => '10 minutes',
  'username' => '< A unique identifier for your user >',
  'name' => $_ENV['USER_NAME'],
  'email' => $_ENV['USER_EMAIL'],
  'suborganization' => '< user suborganization >',
  'role' => 'viewer'
));
?>