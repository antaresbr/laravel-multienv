<?php

//-- customize the env file loading

$app->useEnvironmentPath(rtrim($app->basePath(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'env');

$envId = '';

if ($app->runningInConsole()) {
    $consoleArgs = new \Symfony\Component\Console\Input\ArgvInput();
    if ($consoleArgs->hasParameterOption('--env')) {
        $envId = $consoleArgs->getParameterOption('--env');
    }
}

if (isset($_SERVER['HTTP_APP_ENV_ID'])) {
    $envId = $_SERVER['HTTP_APP_ENV_ID'];
}

if (empty($envId) and isset($_ENV['APP_ENV_ID'])) {
    $envId = $_ENV['APP_ENV_ID'];
}

$envFile = $app->environmentPath() . DIRECTORY_SEPARATOR . '.env.' . (!empty($envId) ? "{$envId}" : 'default');

if (!file_exists($envFile)) {
    throw new Exception("File not found: {$envFile}");
}

$app->loadEnvironmentFrom(basename($envFile));
