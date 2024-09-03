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
class ArchitectureEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', unique: true, nullable: false)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ArchitectureEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ArchitectureEntity
    {
        $this->name = $name;
        return $this;
    }
}
