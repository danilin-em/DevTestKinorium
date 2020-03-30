<?php
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use DataBase\DataBase;
use DataBase\DataBaseInitException;

define('MOVIES_OFFSET', 0);
define('MOVIES_LIMIT', 10);
define('RESULT_JSON_DEPTH', 4);

define('DB_HOST', getenv('DB_HOST', true) ?: '127.0.0.1');
define('DB_NAME', getenv('DB_NAME', true) ?: 'app');
define('DB_USERNAME', getenv('DB_USERNAME', true) ?: 'app');
define('DB_PASSWD', getenv('DB_PASSWD', true) ?: 'app');

try {
    DataBase::init(sprintf('mysql:host=%s;dbname=%s', DB_HOST, DB_NAME), DB_USERNAME, DB_PASSWD);
} catch (DataBaseInitException $e) {
    // TODO: use logger
    exit(json_encode(['error' => 'Sorry... Could not connect to mysql server.']));
}

$movieSearch = DataBase::instance()
    ->prepare('SELECT movie_id as id, title FROM movie LIMIT :offset, :limit;'); // TODO: use col name mapping

$movieSearch->bindValue(':offset', MOVIES_OFFSET, PDO::PARAM_INT);
$movieSearch->bindValue(':limit', MOVIES_LIMIT, PDO::PARAM_INT);

try {
    $movieSearch->execute();
} catch (PDOException $e) {
    // TODO: use logger
    exit(json_encode(['error' => 'Sorry... Search not working.']));
}

$result = $movieSearch->fetchAll(PDO::FETCH_ASSOC);

try {
    exit(json_encode($result, JSON_THROW_ON_ERROR, RESULT_JSON_DEPTH));
} catch (JsonException $e) {
    // TODO: use logger
    exit(json_encode(['error' => 'Oh no! We had Encode problem here.']));
}
