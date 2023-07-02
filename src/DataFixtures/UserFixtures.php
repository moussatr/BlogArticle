<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use \App\Entity\User;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $counter = 1; 
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
    ){}
    public function load(ObjectManager $manager): void
    {
       
             $admin = new User();
             $admin->setEmail('admin@admin.com');
             $admin->setPassword($this->passwordEncoder->hashPassword($admin, 'adminn'));
             $admin->setRoles(['ROLE_ADMIN']);
             $this->setReference('use-'.$this->counter, $admin);
            $this->counter++;
            $manager->persist($admin);

            $faker = Faker\Factory::create('fr_FR');
            for ($i=0; $i <= 5 ; $i++) { 
                $user = new User();
                $user->setEmail($faker->email);
                $user->setPassword($this->passwordEncoder->hashPassword($admin, 'adminn'));
                $user->setRoles(['ROLE_USER']);
                $manager->persist($user);  
            }
    
            $manager->flush();
       
    }
}
