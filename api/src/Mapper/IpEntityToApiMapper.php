<?php

namespace App\Mapper;

use App\ApiResource\IpApiResource;
use App\ApiResource\ServerApiResource;
use App\Entity\IpEntity;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;

#[AsMapper(from: IpEntity::class, to: IpApiResource::class)]
class IpEntityToApiMapper implements MapperInterface
{
    public function __construct(
        private MicroMapperInterface $microMapper,
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof IpEntity);

        $dto     = new IpApiResource();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto    = $to;
        assert($entity instanceof IpEntity);
        assert($dto instanceof IpApiResource);

        $dto->ip     = $entity->getIp();
        $dto->public = $entity->isPublic();
        $dto->server = $this->microMapper->map($entity->getServer(), ServerApiResource::class, [
            MicroMapperInterface::MAX_DEPTH => 1,
        ]);

        return $dto;
    }
}
