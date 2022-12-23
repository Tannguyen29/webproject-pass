<?php

namespace App\DataFixtures;

use App\Entity\Userdetail;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserdetailFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $userdetail = new Userdetail;
        $userdetail->setName("Tan")
                ->setAge(rand(20,60))
                ->setAddress("Hung Yen")
                ->setPhone("09321421414")
                ->setImage("https://znews-photo.zingcdn.me/Uploaded/sotntt/2022_11_29/messi_di_bo_2.jpg");
        $manager->persist($userdetail);

        $manager->flush();
    }
}
