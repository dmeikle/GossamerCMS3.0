<?php

namespace Gossamer\Core\System\Traits;

use Gossamer\Core\System\EntityManager;

trait EntityManagerTrait
{
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager): void
    {
        $this->entityManager = $entityManager;
    }



}