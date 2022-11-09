<?php

namespace App\Repository;

use App\Entity\Identity;
use App\Entity\Mashup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mashup>
 *
 * @method Mashup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mashup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mashup[]    findAll()
 * @method Mashup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MashupRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Mashup::class);
        $this->manager = $manager;
    }

    /**
     * @param string $name
     * @param array $authors
     * @param array $tags
     * @param Identity $user
     * @return void
     */
    public function saveMashup(string $name, array $authors, array $tags, Identity $user): void
    {
        $newMashup = new Mashup();
        $this->addNewProperties($newMashup, $name, $authors, $tags, $user);
        $this->manager->flush();
    }

    /**
     * @param Mashup $mashup
     * @param string $name
     * @param array $authors
     * @param array $tags
     * @param Identity $user
     * @return void
     */
    public function updateMashup(Mashup $mashup, string $name, array $authors, array $tags, Identity $user): void
    {
        $this->deleteOldProperties($mashup);
        $this->addNewProperties($mashup, $name, $authors, $tags, $user);
        $this->manager->flush();
    }

    /**
     * @param Mashup $mashup
     * @return void
     */
    public function removeMashup(Mashup $mashup): void
    {
        $this->deleteOldProperties($mashup);
        $this->manager->remove($mashup);
        $this->manager->flush();
    }

    /**
     * @param Mashup $mashup
     * @param string $name
     * @param array $authors
     * @param array $tags
     * @param Identity $user
     * @return void
     */
    public function addNewProperties(Mashup $mashup, string $name, array $authors, array $tags, Identity $user): void
    {
        $mashup->setName($name);
        foreach ($authors as $author) {
            $mashup->addAuthor($author);
        }
        foreach ($tags as $tag) {
            $mashup->addTag($tag);
        }
        $mashup->setFile("/home/storage/mashups/1.mp3");
        $mashup->setCreatedBy($user);
        $this->manager->persist($mashup);
    }

    /**
     * @param Mashup $mashup
     * @return void
     */
    public function deleteOldProperties(Mashup $mashup): void
    {
        $authors = $mashup->getAuthor();
        foreach ($authors as $author) {
            $mashup->removeAuthor($author);
        }
        $tags = $mashup->getTag();
        foreach ($tags as $tag) {
            $mashup->removeTag($tag);
        }
    }

    /**
     * @param $name
     * @param $tag
     * @param $author
     * @return float|int|mixed|string
     */
    public function searchMashups($name, $author, $tag): mixed
    {
        if (!$name && !$author && !$tag) {
            return $this->findAll();
        }

        $qb = $this->createQueryBuilder('m');
        if ($author && $author !== '') {
            $qb->leftJoin('m.id_author', 'a');
            $qb->andWhere('a.name LIKE :author');
            $qb->setParameter('author', '%' . $author . '%');
        }

        if ($tag && $tag !== '') {
            $qb->leftJoin('m.id_tag', 't');
            $qb->andWhere('t.name LIKE :tag');
            $qb->setParameter('tag', '%' . $tag . '%');
        }

        if ($name && $name !== '') {
            $qb->andWhere('m.name LIKE :name');
            $qb->setParameter('name', '%' . $name . '%');
        }
        return $qb->getQuery()->getResult();
    }
}
