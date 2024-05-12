<?php

namespace RENTAL\SRC;

trait DBModel
{
    protected $tableName = '';
    protected ?int $id = null;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function save()
    {
        $connection = MyConnect::getInstance();

        $properties = get_class_vars(get_class($this));
        unset($properties['tableName']);
        unset($properties['id']);
        $properties = array_keys($properties);

        if (empty($this->id)) {
            $sql = "insert into " . $this->tableName . " (".implode(",", $properties).") values(";
            foreach ($properties as $pos => $property) {
                
                $sql .= "'" . $this->{$property} . "'";

                if ($pos == (count($properties) - 1)) {
                    $sql .= ");";
                } else {
                    $sql .= ", ";
                }
            }

            $connection->query($sql);
            $this->id = $connection->getLastInsertId();
        } else {
            $sql = "update " . $this->tableName . " set ";
            foreach ($properties as $pos => $property) {
                $sql .= $property . " = '" . $this->{$property} . "' ";

                if ($pos == (count($properties) - 1)) {
                    $sql .= " where id = " . $this->id . ";";
                } else {
                    $sql .= ", ";
                }
            }

            
            $connection->query($sql);
        }
    }

    public static function find(int $id, string $tableName = ''): self
    {
        $connection = MyConnect::getInstance();
    
        if ($tableName == '') {
            $class_parts = explode('\\', get_class());
            $tableName = end($class_parts);
            $tableName = self::camelToSnake($tableName);
            $tableName = self::pluralize(2, $tableName);
        }

        $sql = "select * from " . $tableName . " where id = " . $id;
        $result = $connection->query($sql);
        if ($result->num_rows != 1) {
            throw new \Exception('Erro a obter registo. Número de registos diferente de 1');
        }
        $row = $result->fetch_assoc();

        $className = get_class();
        $object = new $className();
        foreach ($row as $column => $value) {
            $object->{$column} = (string) $value;
        }

        return $object;
    }

    public function delete()
    {
        if (empty($this->id)) {
            return;
        }

        $connection = MyConnect::getInstance();
        $sql = "delete from " . $this->tableName . " where id = " . $this->id;
        $connection->query($sql);
    }

    public static function search(array $filters, string $tableName = ''): array
    {
        if ($tableName == '') {
            $class_parts = explode('\\', get_class());
            $tableName = end($class_parts);
            $tableName = self::camelToSnake($tableName);
            $tableName = self::pluralize(2, $tableName);
        }

        $sql = "select * from "
            . $tableName;

        if (!empty($filters)) {
            $sql .= " where ";

            foreach ($filters as $pos => $filter) {
                if ($pos != 0) {
                    $sql .= ' and ';
                }

                $sql .= $filter['column'] . ' ' . $filter['operator'] . ' ' 
                    . "'" . $filter['value'] . "'";    
            }
        }
            
        $connection = MyConnect::getInstance();
        $dbResult = $connection->query($sql);

        $results = [];
        while($row = $dbResult->fetch_assoc()) {
            $className = get_class();
            $object = new $className();
            foreach ($row as $column => $value) {
                $object->{$column} = (string) $value;
            }

            $results[] = $object;
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

    public static function pluralize($quantity, $singular, $plural=null) {
        if ($quantity==1 || !strlen($singular)) {
            return $singular;
        }

        if ($plural!==null) {
            return $plural;
        }
    
        $last_letter = strtolower($singular[strlen($singular)-1]);
        switch($last_letter) {
            case 'a':
                return $singular.'s';
            case 'e':
                return $singular.'s';
            case 'i':
                return $singular.'s';
            case 'o':
                return $singular.'s';
            case 'u':
                return $singular.'s';
            default:
                return $singular.'es';
        }
    }
}