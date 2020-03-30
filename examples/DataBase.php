<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DataBase\DataBase;
use DataBase\DataBaseInitException;

try {
    DataBase::init(sprintf('mysql:host=%s;dbname=%s', '127.0.0.1', 'app'), 'app', 'app');
} catch (DataBaseInitException $e) {
    echo 'Sorry... Could not connect to mysql server.';
    exit(1);
}

$result = [];

$result['movies'] = DataBase::instance()
    ->query('SELECT * FROM movie LIMIT 5;') // TODO: catch PDOException
    ->fetchAll(PDO::FETCH_ASSOC);

$movieSearchById = DataBase::instance()->prepare('SELECT * FROM movie WHERE movie_id = :id;');

$result['searched'] = [];

$movieSearchById->execute([':id' => 4]); // TODO: catch PDOException
$result['searched'][] = $movieSearchById->fetchAll(PDO::FETCH_ASSOC);

$movieSearchById->execute([':id' => 1]); // TODO: catch PDOException
$result['searched'][] = $movieSearchById->fetchAll(PDO::FETCH_ASSOC);

try {
    exit(json_encode($result, JSON_THROW_ON_ERROR, 4));
} catch (JsonException $e) {
    echo 'Oh no! We had Encode problem here.';
    exit(1);
}
