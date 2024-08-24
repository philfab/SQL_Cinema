<?php

namespace models;

abstract class Connect
{
    const HOST = "localhost";
    const DB = "Cinema";
    const USER = "root";
    const PASS = "password";

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
