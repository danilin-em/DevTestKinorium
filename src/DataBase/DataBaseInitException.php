<?php
namespace DataBase;

use \PDOException;

class DataBaseInitException extends PDOException
{
    public function __construct($message, $code = 0, PDOException $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
