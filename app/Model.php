<?php

namespace App;

use \PDO;

/**
 * 
 * @author Patryk Piwko
 * Universal model.
 */
class Model
{
    protected $pdo;
    
    /**
     * Connect to database.
     * 
     * @return \PDO
     */
    public function connect() : \PDO
    {
        $pdo = new PDO(
            'mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_NAME').'', ''.getenv('USER_DB').'', ''.getenv('PASS'), 
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  
            ]
        );
        return $pdo;
    }
    
    /**
     * Get all data wit
     * 
     * @return array
     */
    public function getAll(string $table) : array
    {
        $sql = sprintf(
            'select * from %s',
            $table
        );
        $query = $this->connect()->prepare($sql);
        
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_CLASS);
    }
    
    /**
     * Insert to database.
     *
     * @param string $table what table.
     * @param array  $param what add to db.
     */
    public function insert(string $table, array $param)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($param)),
            ':' . implode(', :', array_keys($param))
        );
        
        $query = $this->connect()->prepare($sql);
        
        $query->execute($param);  
    }  
}