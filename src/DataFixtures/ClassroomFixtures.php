<?php

namespace App\DataFixtures;

use App\Entity\Classroom;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClassroomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $class1 = new Classroom;
        $class1->setclasscode("GCH1002")
               ->setclassname("GreenWich Computer");
        $manager->persist($class1);

        $class2 = new Classroom;
        $class2->setclasscode("GCH1003")
               ->setclassname("GreenWich Computer");
        $manager->persist($class2);

        $class3 = new Classroom;
        $class3->setclasscode("GCH1001")
               ->setclassname("GreenWich Computer");
        $manager->persist($class3);
        
        $manager->flush();
    }
}
