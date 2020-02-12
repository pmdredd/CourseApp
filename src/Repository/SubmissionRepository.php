<?php

namespace App\Repository;

use App\Entity\Submission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class SubmissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Submission::class);
    }

    /**
     * @return mixed
     */
    public function findAllWithStudents()
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.student', 'student')
            ->addSelect('student')
            ->orderBy('s.handInDate', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findStudentAverageMark($studentId)
    {
        return $this->createQueryBuilder('s')
            ->select('avg(s.mark)')
            ->andWhere('s.student = :studentId')
            ->setParameter('studentId', $studentId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
