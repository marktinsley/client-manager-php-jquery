<?php

echo 'Beginning clients seeding.' . PHP_EOL;

$numberOfClientsToCreate = 10000;
$faker = \Faker\Factory::create();

$db->execute('DELETE FROM clients');

for ($i = 1; $i <= $numberOfClientsToCreate; $i++) {
    if ($i % 1000 === 0) {
        echo "{$i} of {$numberOfClientsToCreate}" . PHP_EOL;
    }

    $db->executeWithParams(
        'INSERT INTO clients (first_name, last_name, email, phone) VALUES (?,?,?,?)',
        [$faker->firstName, $faker->lastName, $faker->email, $faker->phoneNumber]
    );
}
