<?php

namespace App\Mapper;

use App\ApiResource\ArchitectureApiResource;
use App\Entity\ArchitectureEntity;
use App\Repository\ArchitectureEntityRepository;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: ArchitectureApiResource::class, to: ArchitectureEntity::class)]
class ArchitectureApiToEntityMapper implements MapperInterface
{
    public function __construct(
        private ArchitectureEntityRepository $architectureEntityRepository,
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof ArchitectureApiResource);

        $architectureEntity = $dto->id ? $this->architectureEntityRepository->find($dto->id) : new ArchitectureEntity();
        if (!$architectureEntity) {
            throw new \Exception('Architecture not found');
        }

        return $architectureEntity;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto    = $from;
        $entity = $to;
        assert($dto instanceof ArchitectureApiResource);
        assert($entity instanceof ArchitectureEntity);

        $entity->setName($dto->name);

        return $entity;
    }
}
