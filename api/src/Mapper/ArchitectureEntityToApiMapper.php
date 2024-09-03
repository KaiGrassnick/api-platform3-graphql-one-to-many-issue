<?php

namespace App\Mapper;

use App\ApiResource\ArchitectureApiResource;
use App\Entity\ArchitectureEntity;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: ArchitectureEntity::class, to: ArchitectureApiResource::class)]
class ArchitectureEntityToApiMapper implements MapperInterface
{
    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof ArchitectureEntity);

        $dto     = new ArchitectureApiResource();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto    = $to;
        assert($entity instanceof ArchitectureEntity);
        assert($dto instanceof ArchitectureApiResource);

        $dto->name = $entity->getName();

        return $dto;
    }
}
