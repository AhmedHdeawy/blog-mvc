<?php

namespace System;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    /**
     * Application Objec
     *
     * @var \System\Application
     */
    private $app;

    /**
     * PDO Object
     *
     * @var \PDO
     */
    private static $connection;

    /**
     * Table Name
     *
     * @var string
     */
    private $table;

    /**
     * Data Container
     *
     * @var array
     */
    private $data = [];

    /**
     * Bindings Container
     *
     * @var array
     */
    private $bindings = [];

    /**
     * Wheres
     *
     * @var array
     */
    private $wheres = [];

    /**
     * Havings
     *
     * @var array
     */
    private $havings = [];

    /**
     * Group By
     *
     * @var array
     */
    private $groupBy = [];

    /**
     * SELECTS
     *
     * @var array
     */
    private $selects = [];

    /**
     * Joins
     *
     * @var array
     */
    private $joins = [];

    /**
     * ORDER BY
     *
     * @var array
     */
    private $orderBy = [];

    /**
     * Limit
     *
     * @var int
     */
    private $limit;

    /**
     * Rows
     *
     * @var int
     */
    private $rows = 0;

    /**
     * Offset
     *
     * @var int
     */
    private $offset;

    /**
     * Last Insert ID
     *
     * @var int
     */
    private $lastId;


    /**
     * Constructor
     *
     * @param \System\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        // Check if exist Connection or Not
        if(! $this->isConnected()) {
            // if not connected, then create connection
            $this->connect();
        }
    }

    /*
     *  Determine if there is any connection to DB
     *
     * @return bool
     */
    private function isConnected()
    {
        return static::$connection instanceof PDO;
    }

    /*
     *  Connect to DB
     *
     * @return void
     */
    private function connect()
    {

        $connectionData = $this->app->file->requireFile('config.php');
        try{
            static::$connection = new PDO('mysql:host='. $connectionData['server'] .';dbname='. $connectionData['dbname'] , $connectionData['dbuser'], $connectionData['dbpass']);

            static::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            static::$connection->exec('SET NAMES utf8');

        } catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Get Database Connection Object PDO Object
     *
     * @return \PDO
     */
    public function connection()
    {
        return static::$connection;
    }

    /**
     * Set selects clause
     *
     * @param array $select
     * @return $this
     */
    public function select(...$select)
    {

        $this->selects = array_merge($this->selects, $select);

        return $this;
    }

    /**
     * Set Join clause
     *
     * @param string $join
     * @return $this
     */
    public function join($join)
    {
        $this->joins[] = $join;

        return $this;
    }

    /**
     * Set Limit and Offset
     *
     * @param int $limit
     * @param int $offset
     * @return $this
     */
    public function limitAndOffset($limit, $offset = 0)
    {
        $this->limit = $limit;

        $this->offset = $offset;

        return $this;
    }

    /**
     * Set Order By Clause
     *
     * @param int $orderBy
     * @param string $sort
     * @return $this
     */
    public function orderBy($orderBy, $sort = 'ASC')
    {
        $this->orderBy = [$orderBy, $sort];

        return $this;
    }

    /**
     * Get total rows from last fetch all statement
     *
     * @return int
     */
    public function rows()
    {
        return $this->rows;
    }

    /**
     * Fetch Table
     * will return one record
     *
     * @param string $table
     * @return \stdClass / null
     */
    public function fetch($table = null)
    {
        if($table) {
            $this->table($table);
        }

        $sql = $this->fetchStatement();

        $result = $this->query($sql, $this->bindings)->fetch();

        $this->reset();

        return $result;
    }

    /**
     * Fetch All records FORM Table
     * will return one record
     *
     * @param string $table
     * @return array
     */
    public function fetchAll($table = null)
    {
        if($table) {
            $this->table($table);
        }

        $sql = $this->fetchStatement();

        $query = $this->query($sql, $this->bindings);

        $results = $query->fetchAll();

        $this->rows = $query->rowCount();

        $this->reset();

        return $results;
    }

    /**
     * DELETE FROM TABLE
     * @param string $table
     * @return $this
     */
    public function delete($table = null)
    {
        if($table) {
            $this->table($table);
        }

        // Run SQL
        $sql = 'DELETE FROM ' . $this->table . ' ';


        // if update statement contains WHERE Then adding it to SQL
        if($this->wheres) {
            $sql .= ' WHERE ' . implode(' ', $this->wheres);
        }


        // Calling QUERY function ( SQL with its Keys,  Values after Filtering
        $this->query($sql, $this->bindings);

        $this->reset();

        return $this;
    }

    /**
     * Prepare Fetch Statement
     * @return string
     */
    private function fetchStatement()
    {
        $sql = 'SELECT ';

        // If User Choose fetch Current Columns OR All(*)
        if($this->selects) {
            $sql .= implode(',', $this->selects);
        } else {
            $sql .= "*";
        }

        // Continue with FROM TABLE_NAME
        $sql .= " FROM " . $this->table . ' ';

        // If JOIN Exist
        if($this->joins) {
            $sql .= implode(' ', $this->joins);
        }

        if($this->wheres) {
            $sql .= ' WHERE ' . implode(' ', $this->wheres);
        }

        if($this->havings) {
            $sql .= ' HAVING ' . implode(' ', $this->havings) . ' ';
        }

        if($this->orderBy) {
            $sql .= " ORDER BY " . implode(' ', $this->orderBy);
        }

        if($this->groupBy) {
            $sql .= " GROUP BY " . implode(' ', $this->groupBy);
        }

        if($this->limit) {
            $sql .= ' LIMIT ' . $this->limit;
        }

        if($this->offset) {
            $sql .= ' OFFSET ' . $this->offset;
        }

        return $sql;
    }



    /**
     * Set tha Table Name, get TABLE_NAME to using it in INSERT and UPDATE
     *
     * @param string $table
     * @return $this
     */
    public function table($table)
    {
        $this->table = $table;
        // return Object contains TableName
        return $this;
    }

    /**
     * Set tha Table Name
     *
     * @param string $table
     * @return $this
     */
    public function from($table)
    {
        // Calling Function [ Table ] to get TABLE_NAME to using it in DELETE and SELECT
        return $this->table($table);
    }

    /**
     * Set the Data that will be stored in DB table
     *
     * @param mixed $key
     * @param mixed $value
     * @return $this
     */
    public function data($key, $value = null)
    {
        // Note that : user can enter the data in the first argument like data(['name' => 'ahmed', 'age' => '22']) and Value = null
        // So we must check if the first argument is array OR not
        // if array the Merge its Keys and Values which in IT
        // such that at the End we will get One Array that contains two arrays Values
        if(is_array($key)) {

            $this->data = array_merge($this->data, $key);

            $this->addToBindings($key);
        } else {
            // If not array, then Stored Normally
            $this->data[$key] = $value;

            $this->addToBindings($value);
        }

        return $this;
    }

    /**
     * INSERT data to DB
     * @param string $table
     * @return $this
     */
    public function insert($table = null)
    {
        if($table) {
            $this->table($table);
        }

        // Run SQL
        $sql = 'INSERT INTO ' . $this->table . ' SET ';

        $sql .= $this->setFields();

        // Calling QUERY function ( SQL with its Keys,  Values after Filtering
        $this->query($sql, $this->bindings);

        $this->lastId = $this->connection()->lastInsertId();

        $this->reset();

        return $this;
    }

    /**
     * UPDATE data to DB
     * @param string $table
     * @return $this
     */
    public function update($table = null)
    {
        if($table) {
            $this->table($table);
        }

        // Run SQL
        $sql = 'UPDATE ' . $this->table . ' SET ';


        $sql .= $this->setFields();


        // if update statement contains WHERE Then adding it to SQL
        if($this->wheres) {
            $sql .= ' WHERE ' . implode(' ', $this->wheres);
        }


        // Calling QUERY function ( SQL with its Keys,  Values after Filtering
        $this->query($sql, $this->bindings);

        $this->reset();

        return $this;
    }

    /**
     * Add New Where Clause
     *
     * @return $this
     */
    public function where()
    {
        $bindings = func_get_args();

        $sql = array_shift($bindings);

        $this->addToBindings($bindings);

        $this->wheres[] = $sql;

        return $this;
    }

    /**
     * Add New Having Clause
     *
     * @return $this
     */
    public function having()
    {
        $bindings = func_get_args();

        $sql = array_shift($bindings);

        $this->addToBindings($bindings);

        $this->havings[] = $sql;

        return $this;
    }

    /**
     * Add New Group By Clause
     * @param array $arguments
     * @return $this
     */
    public function groupBy(...$arguments)
    {
        $this->groupBy = $arguments;

        return $this;
    }

    /**
     * Execute the given SQL
     *
     * @return \PDOStatement
     */
    public function query()
    {
        // Get all Parameters contains ( SQL ) in the first argument
        $bindings = func_get_args();

        // Store the first Argument and Remove it from The $bindings array
        $sql = array_shift($bindings);

        // Now check if $bindings is array and contain one value
        if(count($bindings) == 1 AND is_array($bindings[0])) {
            $bindings = $bindings[0];
        }

        try{
                // Calling PDO Object connection [ new PDO(.........) ]
                $query = $this->connection()->prepare($sql);

                foreach ($bindings as $key => $value) {

                    $query->bindValue($key+1, _e($value));
                }

                $query->execute();

                return $query;

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Set the fields for insert and update
     * @return string
     */
    private function setFields()
    {
        $sql = '';

        // Loop on $this->data which contains Data [ keys => values ]
        foreach (array_keys($this->data) as $key) {

            // Continue with SQL where Adding each KEY with [ ? ]
            $sql .= '`' . $key . '` = ? , ';

        }

        // Remove last comma ( , )
        $sql = rtrim($sql, ', ');

        return $sql;
    }

    /**
     * Add the given Values to bindings
     * @param mixed $value
     *
     * @return void
     */
    public function addToBindings($value)
    {
        // Check if Array or Normal Variable
        if(is_array($value)) {
            // if array, then Merge it with $this->bindings, finally we get one array contains Al( old, new )
            $this->bindings = array_merge($this->bindings, array_values($value));
        } else {
            $this->bindings[] = $value;
        }

    }

    /**
     * Get LastID in DB
     *
     * @return int
     */
    public function lastId()
    {
        return $this->lastId;
    }

    /**
     * Print the Query
     * @return void
     */
    public function printQuery()
    {
        $this->debugDumpParams();
    }

    /**
     * Reset Data
     *
     * @return void
     */
    private function reset()
    {
        $this->limit = null;
        $this->table = null;
        $this->offset = null;
        $this->data = [];
        $this->joins = [];
        $this->wheres = [];
        $this->havings = [];
        $this->groupBy = [];
        $this->orderBy = [];
        $this->selects = [];
        $this->bindings= [];
    }


}
