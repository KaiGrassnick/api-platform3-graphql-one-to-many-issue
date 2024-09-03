<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        new QueryCollection()
    ],
)]
class ServerEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', unique: true, nullable: false)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $memory;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $cores;

    #[ORM\ManyToOne(targetEntity: ArchitectureEntity::class)]
    private ArchitectureEntity $architecture;

    #[ORM\OneToMany(mappedBy: 'server', targetEntity: IpEntity::class)]
    private Collection $ips;

    public function __construct()
    {
        $this->ips = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ServerEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ServerEntity
    {
        $this->name = $name;
        return $this;
    }

    public function getMemory(): int
    {
        return $this->memory;
    }

    public function setMemory(int $memory): ServerEntity
    {
        $this->memory = $memory;
        return $this;
    }

    public function getCores(): int
    {
        return $this->cores;
    }

    public function setCores(int $cores): ServerEntity
    {
        $this->cores = $cores;
        return $this;
    }

    public function getArchitecture(): ArchitectureEntity
    {
        return $this->architecture;
    }

    public function setArchitecture(ArchitectureEntity $architecture): ServerEntity
    {
        $this->architecture = $architecture;
        return $this;
    }

    /**
     * @return Collection<int, IpEntity>
     */
    public function getIps(): Collection
    {
        return $this->ips;
    }

    public function setIps(Collection $ips): ServerEntity
    {
        $this->ips = $ips;
        return $this;
    }
}
