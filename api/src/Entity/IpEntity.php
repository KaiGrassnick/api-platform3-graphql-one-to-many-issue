<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        new QueryCollection()
    ],
)]
class IpEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', unique: true, nullable: false)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: false)]
    private string $ip;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $public;

    #[ORM\ManyToOne(targetEntity: ServerEntity::class, inversedBy: 'ips')]
    private ServerEntity $server;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): IpEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): IpEntity
    {
        $this->ip = $ip;
        return $this;
    }

    public function isPublic(): bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): IpEntity
    {
        $this->public = $public;
        return $this;
    }

    public function getServer(): ServerEntity
    {
        return $this->server;
    }

    public function setServer(ServerEntity $server): IpEntity
    {
        $this->server = $server;
        return $this;
    }


}
