<?php

namespace App\Repository;

use App\Entity\SyslogEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SyslogEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method SyslogEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method SyslogEvent[]    findAll()
 * @method SyslogEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SyslogEventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SyslogEvent::class);
    }

    public function getAllUniqueHostsHashed(bool $refresh_cache = false) : array
    {
        $hosts = $this->getAllUniqueHosts($refresh_cache);
        $ret = [];
        foreach($hosts as $host){
            $ret[ hash('sha1', $host['FromHost'] ) ] = $host['FromHost'];
        }

        return $ret;
    }

    public function getAllUniqueHosts(bool $refresh_cache = false)
    {
        static $hosts;
        if($refresh_cache || !$hosts){
            $hosts = $this->createQueryBuilder('s')
                ->select('s.FromHost')
                ->groupBy('s.FromHost')
                ->getQuery()
                ->getResult()
            ;
        }

        return $hosts;
    }

    public function findMostRecentEventsByHost(string $hostname, int $days = 7)
    {
        return $this->findBy(
            [
                'FromHost' => $hostname,
            ]
        );
    }

    // /**
    //  * @return SyslogEvent[] Returns an array of SyslogEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SyslogEvent
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
