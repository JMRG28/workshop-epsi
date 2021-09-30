<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

     /**
      * @return Question[] Returns an array of Question objects
      */
    
    public function findQuestionFacile()
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.difficulte = :val')
            ->setParameter('val', 'Facile')
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
      * @return Question[] Returns an array of Question objects
      */
    
      public function findQuestionNormale()
      {
          return $this->createQueryBuilder('q')
          ->andWhere('q.difficulte = :val')
          ->setParameter('val', 'Moyen')
              ->orderBy('q.id', 'ASC')
              ->getQuery()
              ->getResult()
          ;
      }

    /**
      * @return Question[] Returns an array of Question objects
      */
    
    public function findQuestionDifficile()
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.difficulte = :val')
            ->setParameter('val', 'Difficile')
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
      * @return Reponse[] Returns an array of reponse objects
      */
    
    public function findIdQuestion($question)
    {
        return $this->createQueryBuilder('q')
        ->andWhere('q.enonce = :val')
        ->setParameter('val', $question)
        ->orderBy('q.id', 'ASC')
        ->getQuery()
        ->getResult()
        ;

    }
  
    

    /*
    public function findOneBySomeField($value): ?Question
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
