<?php

namespace App\Mapper;

use App\ApiResource\IpApiResource;
use App\Entity\IpEntity;
use App\Entity\ServerEntity;
use App\Repository\IpEntityRepository;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;

#[AsMapper(from: IpApiResource::class, to: IpEntity::class)]
class IpApiToEntityMapper implements MapperInterface
{
    public function __construct(
        private IpEntityRepository   $ipEntityRepository,
        private MicroMapperInterface $microMapper,
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof IpApiResource);

        $ipEntity = $dto->id ? $this->ipEntityRepository->find($dto->id) : new IpEntity();
        if (!$ipEntity) {
            throw new \Exception('IP not found');
        }

        return $ipEntity;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto    = $from;
        $entity = $to;
        assert($dto instanceof IpApiResource);
        assert($entity instanceof IpEntity);

        $entity->setIp($dto->ip);
        $entity->setPublic($dto->public);
        $entity->setServer($this->microMapper->map($dto->server, ServerEntity::class, [
            MicroMapperInterface::MAX_DEPTH => 0,
        ]));

        return $entity;
    }
}
