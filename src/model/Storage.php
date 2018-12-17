<?php

namespace Work\Model;

use PDO;

/**
 * Description of Storage
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class Storage
{
    /**
     * @var PDO
     */
    protected static $db;

    protected static $model;

    protected static $table;

    public static function init($config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        //self::$db = new PDO($dsn, $config['user'], $config['pass'], $opt);
    }

    protected static function prepareSet($fields, $source, &$values)
    {
        $set = '';
        $values = [];
        foreach ($fields as $field) {
            if (isset($source[$field])) {
                $set .= "`" . $field . "`" . "=:$field, ";
                $values[$field] = $source[$field];
            }
        }

        return substr($set, 0, -2);
    }

    public static function add(Model $model)
    {
        $sql = "INSERT INTO " . static::$table . " SET " . self::prepareSet($model->fields(), $model->getAttributes(), $values);
        $stm = self::$db->prepare($sql);
        $stm->execute($values);
        return self::$db->lastInsertId();
    }

    public static function find($id)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE id = ?";
        $stm = self::$db->prepare($sql);
        $stm->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\" . static::$model);
        $stm->execute([$id]);
        $model = $stm->fetch(PDO::FETCH_CLASS);

        return $model;
    }
}
