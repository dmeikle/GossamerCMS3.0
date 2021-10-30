<?php

namespace Gossamer\Pesedget\Database\Contracts;

use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Pesedget\Entities\AbstractEntity;

interface ConnectionInterface
{
    public function __construct(array $credentials = null);

    public function __destruct();

    public function getRowCount();

    public function setLogger(LoggingInterface $logger);

    public function getAllRowsAsArray();


    public function beginTransaction();

    public function commitTransaction();

    public function rollbackTransaction();

    public function getConnection();

    public function preparedQuery($query, array $params, $fetch = true);

    public function query($query, $fetch = true);

    public function getTableColumnMappings(AbstractEntity $entity);

    public function getLastQuery();

    public function getCredentials();
}