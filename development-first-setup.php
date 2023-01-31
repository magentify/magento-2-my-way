<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/etc/EnvironmentVariablesLoader.php';

$n98_config_env_set = __DIR__ . '/vendor/bin/n98-magerun2 config:env:set ';

echo shell_exec($n98_config_env_set . 'backend.frontName ' . $_ENV['ENV_PHP__BACKEND__FRONTENDNAME']);
echo shell_exec($n98_config_env_set . 'db.connection.default.host ' . $_ENV['ENV_PHP__DB__HOST']);
echo shell_exec($n98_config_env_set . 'db.connection.default.dbname ' . $_ENV['ENV_PHP__DB__DBNAME']);
echo shell_exec($n98_config_env_set . 'db.connection.default.password ' . $_ENV['ENV_PHP__DB__PASSWORD' ?? '""']);
echo shell_exec($n98_config_env_set . 'db.connection.default.username ' . $_ENV['ENV_PHP__DB__USERNAME']);
echo shell_exec($n98_config_env_set . 'session.redis.host ' . $_ENV['ENV_PHP__SESSION__REDIS__HOST']);
echo shell_exec($n98_config_env_set . 'session.redis.port ' . $_ENV['ENV_PHP__SESSION__REDIS__PORT']);
echo shell_exec($n98_config_env_set . 'session.redis.password ' . $_ENV['ENV_PHP__SESSION__REDIS__PASSWORD' ?? '""']);
