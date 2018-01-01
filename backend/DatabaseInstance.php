<?php

/**
 * Class that provides connection with database
 *
 * Singleton design pattern
 */
class DatabaseInstance
{
    /**
     * @var PDO
     */
    private $dbh;
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * Get connection with database
     *
     * DatabaseInstance constructor.
     */
    private function __construct()
    {
        $this->dbh = new PDO("mysql:dbname=todolist;host=localhost", "root", "");
    }

    /**
     * Returns static variable of object
     *
     * When object doesnt exist this function will create new one
     * and assign it to the static variable
     *
     * @return DatabaseInstance|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseInstance();
        }
        return self::$instance;
    }

    /**
     * Returns connection with database
     *
     * @return PDO
     */
    public function getConnection()
    {
        return $this->dbh;
    }
}

?>