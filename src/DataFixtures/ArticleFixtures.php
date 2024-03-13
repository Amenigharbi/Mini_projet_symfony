<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\Entity\Article;
class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
     { for($i=1;$i<=10;$i++)
{
$article=new Article();
$article->setTitle("Titre de l'article num $i")
->setContent("<p>Le contenu de l'article n° $i</p>")
->setImage("https://upload.wikimedia.org/wikipedia/commons/e/e3/Tunis
ia_logo.svg")
 ->setCreatedAt(new \DateTimeImmutable());
$manager->persist($article);
}
$manager->flush();
}
}
