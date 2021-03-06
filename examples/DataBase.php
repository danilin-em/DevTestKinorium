<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DataBase\DataBase;
use DataBase\DataBaseInitException;

try {
    // TODO: use config instead hardcode
    DataBase::init(sprintf('mysql:host=%s;dbname=%s', '127.0.0.1', 'app'), 'app', 'app');
} catch (DataBaseInitException $e) {
    exit('Sorry... Could not connect to mysql server.'); // TODO: use logger
}

$result = [];

// TODO: catch PDOException
$result['movies'] = DataBase::instance()
    ->query('SELECT * FROM movie LIMIT 5;') // TODO: drop magick number
    ->fetchAll(PDO::FETCH_ASSOC);

$movieSearchById = DataBase::instance()->prepare('SELECT * FROM movie WHERE movie_id = :id;');

$result['searched'] = [];

$movieSearchById->execute([':id' => 4]); // TODO: catch PDOException
$result['searched'][] = $movieSearchById->fetchAll(PDO::FETCH_ASSOC);

$movieSearchById->execute([':id' => 1]); // TODO: catch PDOException
$result['searched'][] = $movieSearchById->fetchAll(PDO::FETCH_ASSOC);

try {
    exit(json_encode($result, JSON_THROW_ON_ERROR, 4)); // TODO: drop magick number
} catch (JsonException $e) {
    exit('Oh no! We had Encode problem here.'); // TODO: use logger
}
