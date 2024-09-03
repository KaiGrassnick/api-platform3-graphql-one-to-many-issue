<?php declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Entity\ServerEntity;
use App\State\EntityClassDtoStateProcessor;
use App\State\EntityClassDtoStateProvider;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    graphQlOperations: [
        new Query(),
        new QueryCollection()
    ],
    provider: EntityClassDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: ServerEntity::class),
)]
class ServerApiResource
{
    #[ApiProperty(readable: false, writable: false, identifier: true)]
    public ?int $id = null;

    public string $name;

    public int $memory;

    public int $cores;

    public ArchitectureApiResource $architecture;

    /**
     * Also tried:
     *  - IpApiResource[]
     *  - list<IpApiResource>
     *  - list<int, IpApiResource>
     *  - array<IpApiResource>
     *  - array<int, IpApiResource>
     *  - Collection<IpApiResource>
     *  - Collection<int, IpApiResource>
     *
     * @var array<int, IpApiResource>
     */
    public array $ips = [];
}
