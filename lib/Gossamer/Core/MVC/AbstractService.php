<?php

namespace Gossamer\Core\MVC;

use Gossamer\Core\DTOs\DTOInterface;
use Gossamer\Core\Http\Requests\HttpRequest;
use Gossamer\Core\System\EntityManager;
use Gossamer\Core\System\Traits\EntityManagerTrait;
use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Horus\Http\Traits\HttpRequestTrait;
use Gossamer\Horus\Http\Traits\HttpResponseTrait;
use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Neith\Logging\Traits\LoggingTrait;
use Gossamer\Pesedget\Database\Utils\ListResult;
use Gossamer\Set\Utils\Container;
use Gossamer\Set\Utils\Traits\ContainerTrait;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractService
{

    use ContainerTrait;
    use EntityManagerTrait;
    use HttpRequestTrait;
    use HttpResponseTrait;
    use LoggingTrait;

    public function __construct(Container $container, EntityManager $entityManager, HttpRequest $httpRequest, HttpResponse $httpResponse, LoggingInterface $logger) {
        $this->container = $container;
        $this->entityManager = $entityManager;
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->logger = $logger;
    }

    protected function getKey(DTOInterface $dto) {
        if(strlen($dto->getId()) == 0) {
            return getGUID();
        }

        return $dto->getId();
    }

    protected function getBasicList(int $offset, int $limit, array $searchParams, Builder $builder) {

        $max = $builder->get()->count();

        // apply offset & limit only if provided
        if ($limit > 0) {
            $builder = $builder->take($limit);

            if ($offset > 0) {
                $builder = $builder->skip($offset);
            }
        }

        $result = $builder->get();

        return new ListResult($max, $result);
    }
}
