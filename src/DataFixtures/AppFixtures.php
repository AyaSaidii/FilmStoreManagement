<?php

namespace App\DataFixtures;
use  App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private  $passwordHasher;
    public function __construct(UserPasswordHasherInterface  $passwordHasher){
       $this->passwordHasher=$passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $plainPassword="admin1234";
        $hashedPassword=$this->passwordHasher->hashPassword($user,$plainPassword);
        $user->setUsername('admin');
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}
