<?php

namespace RENTAL\SRC;

class MyConnect
{
    protected $connection;
    private static $instance = null;

    private function __construct()
    {
        $config = parse_ini_file('db.ini');

        $this->connection = new \mysqli(
            $config['DBHOST'],
            $config['DBUSER'],
            $config['DBPASS'],
            $config['DBNAME'],
            $config['DBPORT']
        );
    }

    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new MyConnect();
        }

        return self::$instance;
    }

    public function query(string $sql)
    {
        return $this->connection->query($sql);
    }

    public function insert($sql)
    {
        $this->connection->query($sql);
        return $this->connection->insert_id;
    }

    public function getLastInsertId()
    {
        return $this->connection->insert_id;
    }
}