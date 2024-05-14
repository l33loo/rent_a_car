<?php

namespace RENTAL\SRC;

class MyConnect
{
    protected $connection;
    private static $instance = null;

    private function __construct()
    {
        $config = parse_ini_file('db.ini');

        $dbh = "mysql:host={$config['DBHOST']};dbname={$config['DBNAME']};port={$config['DBPORT']};charset=utf8mb4";

        try {
            $this->connection = new \PDO($dbh, $config['DBUSER'], $config['DBPASS']);

            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $result = $this->connection->query('SELECT 1');
            if ($result === false) {
                throw new \PDOException('Erro ao executar a consulta no banco de dados.');
            }

            echo "Conexão com o banco de dados está funcionando corretamente!";
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new MyConnect();
        }

        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    public function query(string $sql)
    {
        return $this->connection->query($sql);
    }

    public function insert($sql)
    {
        $this->connection->exec($sql);
        return $this->connection->lastInsertId();
    }

    public function getLastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}