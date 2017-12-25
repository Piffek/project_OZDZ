<?php

namespace Src;

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
    public function connect(): \PDO
    {
        $pdo = new PDO('mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_NAME').'', ''.getenv('USER_DB').'', ''.getenv('PASS'), [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            ]);

        return $pdo;
    }

    /**
     * Get all data wit
     *
     * @return array
     */
    public function getAll(string $table): array
    {
        $sql = sprintf('select * from %s', $table);
        $query = $this->connect()->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Insert to database.
     *
     * @param string $table what table.
     * @param array $param what add to db.
     */
    public function insert(string $table, array $param)
    {
        $sql = sprintf('insert into %s (%s) values (%s)', $table, implode(', ', array_keys($param)), ':'.implode(', :', array_keys($param)));

        $query = $this->connect()->prepare($sql);

        $query->execute($param);
    }

    public function get(string $what, string $table, string $rowName, $name)
    {
        $query = $this->connect()->prepare("SELECT ".$what." FROM ".$table." WHERE ".$rowName." = :value");

        $query->bindParam(':value', $name);

        $query->execute();

        return $query->fetch();
    }

    public function updateOne(string $table, string $data, string $toData, int $id)
    {
        $query = $this->connect()->prepare("UPDATE ".$table." SET ".$data." = :value WHERE id = :id");

        $query->bindParam(':value', $toData, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();
    }
}