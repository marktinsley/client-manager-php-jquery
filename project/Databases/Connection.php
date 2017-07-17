<?php

namespace Project\Databases;

use PDO;

class Connection
{
    private static $instance;

    /**
     * @var PDO
     */
    private $connection;

    /**
     * Constructor.
     */
    private function __construct()
    {
        $dsn = 'sqlite:' . realpath(__DIR__ . '/../../database/database.sqlite');

        $this->connection = new PDO($dsn);
    }

    /**
     * Gives you an instance of the session.
     *
     * @return static
     */
    public static function getInstance()
    {
        if ( ! self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * Gives you all rows and records from query.
     * 
     * @param $query
     * @param array $params
     *
     * @return array
     */
    public function getAll($query, array $params = [])
    {
        return $this->executeWithParams($query, $params)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Gives you the first column's value from the first row.
     *
     * @param $query
     * @param array $params
     *
     * @return mixed
     */
    public function getOne($query, array $params = [])
    {
        return $this->executeWithParams($query, $params)
            ->fetchColumn();
    }

    /**
     * Gives you the first row in the resultset.
     * 
     * @param $query
     * @param array $params
     * 
     * @return mixed
     */
    public function getRow($query, array $params)
    {
        return $this->executeWithParams($query, $params)
            ->fetch();
    }

    /**
     * Execute a statement.
     *
     * @param $statement
     *
     * @return int
     */
    public function execute($statement)
    {
        return $this->connection->exec($statement);
    }

    /**
     *
     *
     * @param $statement
     * @param array $params
     *
     * @return \PDOStatement
     */
    public function executeWithParams($statement, array $params = [])
    {
        $sth = $this->connection->prepare($statement);

        $sth->execute($params);

        return $sth;
    }
}