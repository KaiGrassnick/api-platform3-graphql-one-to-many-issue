<?php

namespace App\Mapper;

use App\ApiResource\ArchitectureApiResource;
use App\ApiResource\IpApiResource;
use App\ApiResource\ServerApiResource;
use App\Entity\IpEntity;
use App\Entity\ServerEntity;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;

#[AsMapper(from: ServerEntity::class, to: ServerApiResource::class)]
class ServerEntityToApiMapper implements MapperInterface
{
    public function __construct(
        private MicroMapperInterface $microMapper,
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof ServerEntity);

        $dto = new ServerApiResource();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto = $to;
        assert($entity instanceof ServerEntity);
        assert($dto instanceof ServerApiResource);

        $dto->name = $entity->getName();
        $dto->memory = $entity->getMemory();
        $dto->cores = $entity->getCores();
        $dto->architecture = $this->microMapper->map($entity->getArchitecture(), ArchitectureApiResource::class, [
            MicroMapperInterface::MAX_DEPTH => 1,
        ]);
        $dto->ips = array_map(function(IpEntity $ip) {
            return $this->microMapper->map($ip, IpApiResource::class, [
                MicroMapperInterface::MAX_DEPTH => 1,
            ]);
        }, $entity->getIps()->getValues());

        return $dto;
    }
}
