<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $firstCategory = new Category();
        $firstCategory->setName("First Category");

        $secondCategory = new Category();
        $secondCategory->setName("Second Category");

        $manager->persist($firstCategory);
        $manager->persist($secondCategory);

        $manager->flush();
    }
}
