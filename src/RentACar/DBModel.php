<?php

namespace RentACar;
require_once($_SERVER['DOCUMENT_ROOT'] . '/RentACar/MyConnect.php');

use RentACar\MyConnect;

trait DBModel
{
    protected $tableName = '';
    protected ?int $id = null;

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    public function save()
    {
        $connection = MyConnect::getInstance()->getConnection();

        $properties = get_object_vars($this);
        unset($properties['tableName']);
        unset($properties['id']);

        if (empty($this->id)) {
            $sql = "INSERT INTO " . $this->tableName . " (" . implode(",", array_keys($properties)).") VALUES(";
            $params = [];
            foreach ($properties as $property => $value) {
                $sql .= "?,";

                // PDO does not accept booleans, so they need to be converted
                // to their int equivalent.
                $params[] = is_bool($value) ? (int)$value: $value;
                
                // // This function may return Boolean false, but may also return a
                // // non-Boolean value which evaluates to false. Use the === operator
                // // for testing the return value of this function.
                // if (next($properties) !== false) {
                //     $sql .= ", ";
                // }
            }

            // next() doesn't work because its return values conflict and this gives error.
            $sql = rtrim($sql, ',');
            $sql .= ");";

            $stmt = $connection->prepare($sql);
            $stmt->execute($params);
            $this->id = $connection->lastInsertId();
        } else {
            $sql = "UPDATE " . $this->tableName . " SET ";
            $params = [];
            foreach ($properties as $property => $value) {
                $sql .= $property . " = ?";

                $params[] = $value;
                
                if (next($properties) !== false) {
                    $sql .= ", ";
                }
            }
            $sql .= " WHERE id = ?;";
            $params[] = $this->id;

            $stmt = $connection->prepare($sql);
            $stmt->execute($params);
        }
    }

    public static function find(int $id, string $tableName = ''): self
    {
        $connection = MyConnect::getInstance()->getConnection();

        if ($tableName === '') {
            $class_parts = explode('\\', static::class);
            $tableName = end($class_parts);
            $tableName = self::camelToSnake($tableName);
            // $tableName = self::pluralize(2, $tableName);
        }

        $sql = "SELECT * FROM " . $tableName . " WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchObject(static::class);

        if (!$result) {
            throw new \Exception('Erro a obter registo. Número de registos diferente de 1');
        }

        return $result;
    }

    public function delete()
    {
        if (empty($this->id)) {
            return;
        }

        $connection = MyConnect::getInstance()->getConnection();
        $sql = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$this->id]);
    }

    public static function search(array $filters, string $tableName = ''): array
    {
        if ($tableName === '') {
            $class_parts = explode('\\', static::class);
            $tableName = end($class_parts);
            $tableName = self::camelToSnake($tableName);
            // $tableName = self::pluralize(2, $tableName);
        }

        $sql = "SELECT * FROM " . $tableName;

        if (!empty($filters)) {
            $sql .= " WHERE ";

            foreach ($filters as $pos => $filter) {
                if ($pos !== 0) {
                    $sql .= ' AND ';
                }

                $sql .= $filter['column'] . ' ' . $filter['operator'] . ' ?';
            }
        }

        $connection = MyConnect::getInstance()->getConnection();
        $stmt = $connection->prepare($sql);
        
        $params = array_column($filters, 'value');
        $stmt->execute($params);

        $results = [];
        while($row = $stmt->fetchObject(static::class)) {
            // print_r($row);
            $results[] = $row;
        }

        return $results;
    }

    public static function camelToSnake($camelCase) {
        $result = '';
      
        for ($i = 0; $i < strlen($camelCase); $i++) {
            $char = $camelCase[$i];
      
            if (ctype_upper($char)) {
                $result .= '_' . strtolower($char);
            } else {
                $result .= $char;
            }
        }
      
        return ltrim($result, '_');
    }

    // public static function pluralize($quantity, $singular, $plural=null) {
    //     if ($quantity==1 || !strlen($singular)) {
    //         return $singular;
    //     }

    //     if ($plural!==null) {
    //         return $plural;
    //     }
    
    //     $last_letter = strtolower($singular[strlen($singular)-1]);
    //     switch($last_letter) {
    //         case 'a':
    //             return $singular.'s';
    //         case 'e':
    //             return $singular.'s';
    //         case 'i':
    //             return $singular.'s';
    //         case 'o':
    //             return $singular.'s';
    //         case 'u':
    //             return $singular.'s';
    //         default:
    //             return $singular.'es';
    //     }
    // }
}