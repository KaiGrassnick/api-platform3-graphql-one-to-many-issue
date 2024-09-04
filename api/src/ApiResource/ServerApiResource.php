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
     * @var IpApiResource[]
     */
    public array $ips = [];

    public function addIp(IpApiResource $ip): void
    {
        $this->ips[] = $ip;
    }

    public function removeIp(IpApiResource $ip): void
    {
        unset($this->ips[array_search($ip, $this->ips)]);
    }
}
