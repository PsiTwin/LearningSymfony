<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Tag::class);
        $this->manager = $manager;
    }
    public function saveTag(string $name, bool $isHidden)
    {
        $newTag = new Tag();

        $newTag->setName($name);
        $newTag->setHidden($isHidden);
        $this->manager->persist($newTag);
        $this->manager->flush();
    }

    public function updateTag(Tag $tag): Tag
    {
        $this->manager->persist($tag);
        $this->manager->flush();

        return $tag;
    }

    public function removeTag(Tag $tag)
    {
        $this->manager->remove($tag);
        $this->manager->flush();
    }
}
