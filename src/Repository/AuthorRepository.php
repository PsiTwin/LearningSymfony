<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $manager;

    public function __construct(
        ManagerRegistry        $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Author::class);
        $this->manager = $manager;
    }

    /**
     * @param string $name
     * @return void
     */
    public function saveAuthor(string $name): void
    {
        $newAuthor = new Author();

        $newAuthor->setName($name);
        $newAuthor->setIsBanned(false);
        $this->manager->persist($newAuthor);
        $this->manager->flush();
    }

    /**
     * @param Author $author
     * @return Author
     */
    public function updateAuthor(Author $author): Author
    {
        $this->manager->persist($author);
        $this->manager->flush();

        return $author;
    }

    /**
     * @param Author $author
     * @return void
     */
    public function removeAuthor(Author $author): void
    {
        $this->manager->remove($author);
        $this->manager->flush();
    }

    /*
    public function findOneBySomeField($value): ?Author
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
