<?php

namespace models;

abstract class Connect
{
    const HOST = "localhost";
    const DB = "cinema";
    const USER = "root";
    const PASS = "";

    public static function Connection()
    {
        try {
            return new \PDO(
                "mysql:host=" . self::HOST . ";dbname=" . self::DB . ";charset=utf8",
                self::USER,
                self::PASS
            );
        } catch (\PDOException $exception) {
            return $exception->getMessage();
        }
    }
}
