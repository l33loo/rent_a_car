<?php

namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\MyConnect;

trait DBModel
{
    protected $tableName = '';
    protected ?int $id = null;

    /**
     * Get the value of id
     * 
     * @return int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     * 
     * @return self
     */ 
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;

    }

    public function save()
    {
        $connection = MyConnect::getInstance()->getConnection();

        $properties = get_object_vars($this);
        unset($properties['tableName']);
        unset($properties['id']);
        if (array_key_exists('properties', $properties)) {
            unset($properties['properties']);
        }

        $propertyKeys = array_keys($properties);
        $foreignKeys = preg_grep('/_id$/', $propertyKeys);

        // Strip properties that are objects or arrays, because the latter
        // are stored in different tables.
        foreach ($properties as $propertyKey => $propertyValue) {
            // If there is a corresponding `{property}_id`, it means the current
            // property is for an object that maps to another db table.
            if (key_exists($propertyKey . '_id', $properties) || is_array($propertyValue)) {
                unset($properties[$propertyKey]);
            }
        }

        if (empty($this->id)) {
            $sql = 'INSERT INTO ' . $this->tableName . ' (' . implode(',', array_keys($properties)).') VALUES(';
            $params = [];
            foreach ($properties as $property => $value) {
                $sql .= '?,';

                // PDO does not accept booleans, so they need to be converted
                // to their int equivalent.
                $params[] = is_bool($value) ? (int)$value: $value;
            }

            $sql = rtrim($sql, ',');
            $sql .= ');';

            $stmt = $connection->prepare($sql);
            $stmt->execute($params);
            $this->id = $connection->lastInsertId();
        } else {
            $sql = 'UPDATE ' . $this->tableName . ' SET ';
            $params = [];
            foreach ($properties as $property => $value) {
                $sql .= $property . ' = ?,';

                // PDO does not accept booleans, so they need to be converted
                // to their int equivalent.
                $params[] = is_bool($value) ? (int)$value: $value;
            }

            $sql = rtrim($sql, ',');
            $sql .= ' WHERE id = ?;';
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
            throw new \Exception('Error retrieving row. Number of results not equal to 1.');
        }

        return $result;
    }

    public function delete()
    {
        if (empty($this->id)) {
            return;
        }

        $params = [];
        $params[] = $this->id;
        $connection = MyConnect::getInstance()->getConnection();
        $sql = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute($params);
    }

    public static function search(array $filters, string $tableName = '', ?string $orderBy = null, ?string $order = null, ?int $limit = null): array
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

        if (!empty($orderBy)) {
            $sql .= " ORDER BY $orderBy";
        }

        if (!empty($order)) {
            $sql .= " $order";
        }

        if (!empty($limit)) {
            $sql .= " LIMIT $limit";
        }

        $connection = MyConnect::getInstance()->getConnection();
        $stmt = $connection->prepare($sql);
        
        $params = array_column($filters, 'value');
        $stmt->execute($params);

        $results = [];
        while($row = $stmt->fetchObject(static::class)) {
            $results[] = $row;
        }

        return $results;
    }

    public function loadRelation(string $relationName, string $tableName = ''): self
    {
        if ($this->{$relationName . '_id'} === null) {
            return $this;
        }
        
        if ($tableName === '') {
            $tableName = $relationName;
        }
        
        $className = 'RentACar\\' . self::snakeToCamel($tableName);
        
        $this->{$relationName} = $className::find($this->{$relationName . '_id'}, $tableName);

        return $this;
    }

    public static function rawSQL(string $sql): \PDOStatement
    {
        $connection = MyConnect::getInstance();
        return $connection->query($sql);
    }

    public static function camelToSnake(string $camelCase): string
    {
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

    public static function snakeToCamel($string, $capitalizeFirstCharacter = true): string
    {

        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }
    
        return $str;
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