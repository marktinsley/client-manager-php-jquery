<?php

echo 'Beginning users seeding.' . PHP_EOL;

$db->execute('DELETE FROM users');
foreach ([['username' => 'demo', 'password' => 'testing123']] as $user) {
    $password = \Project\Hashing\Password::hash($user['password']);

    if ($password === false) {
        throw new RuntimeException('Bcrypt hashing not supported.');
    }

    $db->executeWithParams('INSERT INTO users (username, password) VALUES (?,?)', [$user['username'], $password]);
}
