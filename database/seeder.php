<?php

echo 'Beginning seeding.' . PHP_EOL;

require __DIR__ . '/../vendor/autoload.php';

$db = \Project\Databases\Connection::getInstance();

require __DIR__ . '/seeder/clients.php';
require __DIR__ . '/seeder/users.php';

echo 'All done.' . PHP_EOL;
