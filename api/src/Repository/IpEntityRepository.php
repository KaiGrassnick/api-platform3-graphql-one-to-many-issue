<?php

namespace App\Repository;

use App\Entity\IpEntity;
use App\Entity\ServerEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<IpEntity>
 *
 * @method ServerEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServerEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServerEntity[]    findAll()
 * @method ServerEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IpEntity::class);
    }

    public function save(IpEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IpEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
