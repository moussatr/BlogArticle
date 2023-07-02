<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use Faker;
class CategoriesFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i=0; $i < 10; $i++) { 
            $category = new Category();
            $category->setName($faker->text(15));
           
            $manager->persist($category);
            $this->addReference('cat-'.$i, $category);
            
           
           $manager->flush();
        }
        
    }
}
