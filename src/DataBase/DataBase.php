<?php

namespace DataBase;

use \PDO;
use \PDOException;

use DataBaseInitException;
use DataBaseNotInitedException;

class DataBase
{
    protected static $instance = null;
    final private function __construct()
    {
    }
    final private function __clone()
    {
    }
    public static function init(string $dsn = null, string $username = null, string $passwd = null): void
    {
        try {
            self::$instance = new PDO($dsn, ...[$username, $passwd]);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new DataBaseInitException($e->getMessage(), 0, $e);
        }
    }
    public static function instance(): PDO
    {
        if (self::$instance === null) {
            throw new DataBaseNotInitedException('Instance Not Inited. You need init database instance first.', 0);
        }
        return self::$instance;
    }
}
