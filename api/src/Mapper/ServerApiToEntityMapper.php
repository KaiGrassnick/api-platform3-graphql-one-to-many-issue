<?php

namespace App\Mapper;

use App\ApiResource\ServerApiResource;
use App\Entity\ArchitectureEntity;
use App\Entity\IpEntity;
use App\Entity\ServerEntity;
use App\Repository\ServerEntityRepository;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;

#[AsMapper(from: ServerApiResource::class, to: ServerEntity::class)]
class ServerApiToEntityMapper implements MapperInterface
{
    public function __construct(
        private ServerEntityRepository    $serverEntityRepository,
        private MicroMapperInterface      $microMapper,
        private PropertyAccessorInterface $propertyAccessor,
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof ServerApiResource);

        $serverEntity = $dto->id ? $this->serverEntityRepository->find($dto->id) : new ServerEntity();
        if (!$serverEntity) {
            throw new \Exception('Server not found');
        }

        return $serverEntity;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto    = $from;
        $entity = $to;
        assert($dto instanceof ServerApiResource);
        assert($entity instanceof ServerEntity);

        $entity->setName($dto->name);
        $entity->setMemory($dto->memory);
        $entity->setCores($dto->cores);

        $entity->setArchitecture($this->microMapper->map($dto->architecture, ArchitectureEntity::class, [
            MicroMapperInterface::MAX_DEPTH => 0,
        ]));

        $ipEntities = [];
        foreach ($dto->ips as $ipApiResource) {
            $ipEntities[] = $this->microMapper->map($ipApiResource, IpEntity::class, [
                MicroMapperInterface::MAX_DEPTH => 0,
            ]);
        }
        $this->propertyAccessor->setValue($entity, 'ips', $ipEntities);

        return $entity;
    }
}
