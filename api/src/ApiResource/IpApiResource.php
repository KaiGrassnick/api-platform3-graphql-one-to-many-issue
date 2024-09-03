<?php declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Entity\IpEntity;
use App\State\EntityClassDtoStateProcessor;
use App\State\EntityClassDtoStateProvider;


#[ApiResource(
    graphQlOperations: [
        new Query(),
        new QueryCollection()
    ],
    provider: EntityClassDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: IpEntity::class),
)]
class IpApiResource
{
    #[ApiProperty(readable: true, writable: false, identifier: true)]
    public ?int $id = null;

    public string $ip;

    public bool $public;

    public ServerApiResource $server;
}
