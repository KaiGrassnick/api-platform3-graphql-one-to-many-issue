<?php

namespace App\Repository;

use App\Entity\ServerEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<ServerEntity>
 *
 * @method ServerEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServerEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServerEntity[]    findAll()
 * @method ServerEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServerEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServerEntity::class);
    }

    public function save(ServerEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ServerEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
