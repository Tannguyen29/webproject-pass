<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->hasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User;
        $user1->setEmail("admin1@gmail.com")
              ->setRoles(["ROLE_ADMIN"])
              ->setPassword($this->hasher->hashPassword($user1,"123456"));
        $manager->persist($user1);
        
        $manager->flush();
    }
}