<?php
namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i=0; $i < 50; $i++) { 
            $article = new Article();
            $article->setTitle($faker->text(15));
            $article->setContent($faker->text(1000));
            $manager->persist($article);

            $this->setReference('art-'.$i, $article);

            $category = $this->getReference('cat-'.rand(1,1));
            $article->setCategory($category);

            $admin = $this->getReference('use-'.rand(1,1));
            $article->setUser($admin);
        }

        $manager->flush();
    }
    public function getDependencies(): array {
        return [
            CategoriesFixtures::class,
            UserFixtures::class
        ];
    }

}
