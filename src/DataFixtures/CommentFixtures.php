<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
       $comment = new Comment();
       $comment->setContent($faker->text(15));
       $article = $this->getReference('art-'.rand(1,1));
       $comment->setArticle($article);
       $admin = $this->getReference('use-'.rand(1,1));
       $comment->setUser($admin);

        $manager->flush();
    }

    public function getDependencies(): array {
        return [
            UserFixtures::class,
            
        ];
    }
}
