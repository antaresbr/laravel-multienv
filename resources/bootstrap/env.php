<?php

//-- customize the env file
$app->useEnvironmentPath($app->basePath() . DIRECTORY_SEPARATOR . 'env');

$envId = '';
if (isset($_SERVER['HTTP_APP_ENV_ID'])) {
    $envId = $_SERVER['HTTP_APP_ENV_ID'];
}
if (empty($envId) and isset($_ENV['APP_ENV_ID'])) {
    $envId = $_ENV['APP_ENV_ID'];
}

$envId = !empty($envId) ? ".{$envId}" : '';

$app->loadEnvironmentFrom(".env{$envId}");
