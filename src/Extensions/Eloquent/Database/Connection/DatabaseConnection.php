<?php

namespace Extensions\Eloquent\Database\Connection;

use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Pesedget\Database\Contracts\ConnectionInterface;
use Gossamer\Pesedget\Database\Contracts\GossamerDBConnection;
use Gossamer\Pesedget\Entities\AbstractEntity;
use Illuminate\Database\Capsule\Manager;

class DatabaseConnection implements ConnectionInterface, GossamerDBConnection
{
    private $capsule;

    private $credentials;

    public function __construct(array $credentials = null) {
        $this->credentials = $credentials;
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public function getRowCount()
    {
        // TODO: Implement getRowCount() method.
    }

    public function setLogger(LoggingInterface $logger)
    {
        // TODO: Implement setLogger() method.
    }

    public function getAllRowsAsArray()
    {
        // TODO: Implement getAllRowsAsArray() method.
    }

    public function beginTransaction()
    {
        // TODO: Implement beginTransaction() method.
    }

    public function commitTransaction()
    {
        // TODO: Implement commitTransaction() method.
    }

    public function rollbackTransaction()
    {
        // TODO: Implement getConnection() method.
    }

    public function getConnection()
    {
        if(is_null($this->capsule)) {
            $this->capsule = new Manager();
            $this->capsule->addConnection([
                "driver" => "mysql",
                "host" => $this->credentials['host'],
                "database" => $this->credentials['dbName'],
                "username" => $this->credentials['username'],
                "password" => $this->credentials['password']
            ]);
            $this->capsule->setAsGlobal();
            $this->capsule->bootEloquent();
        }
        return $this->capsule;
    }

    public function preparedQuery($query, array $params, $fetch = true)
    {
        // TODO: Implement preparedQuery() method.
    }

    public function query($query, $fetch = true)
    {
        // TODO: Implement query() method.
    }

    public function getTableColumnMappings(AbstractEntity $entity)
    {
        // TODO: Implement getTableColumnMappings() method.
    }

    public function getLastQuery()
    {
        // TODO: Implement getLastQuery() method.
    }

    public function getCredentials()
    {
        // TODO: Implement getCredentials() method.
    }
}