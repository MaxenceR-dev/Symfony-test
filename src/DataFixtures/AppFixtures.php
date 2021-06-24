<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


use Faker;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $users = [];
        $categories=[];
        $articles=[];

        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername($faker->name)
                ->setFirstname($faker->firstname)
                ->setLastname($faker->lastname)
                ->setEmail($faker->email)
                ->setPassword($faker->password)

                ->setCreatedAt(new \DateTime);

            $manager->persist($user);

            $users[] = $user;
        }
        // $product = new Product();
        // $manager->persist($product);


        for($i = 0; $i<15;$i++){
            $category= new Category();
            $category->setTitle($faker->text(50))
            ->setDescription($faker->text(250))
            ->setImage($faker->imageUrl());

            $manager->persist($category);
            $categories[] = $category;
         
        }

        for($i = 0; $i<100; $i++){
            $article= new Article();
            $article->setTitle($faker->text(50))
            ->setContent($faker->text(255))
            ->setImage($faker->imageUrl())
            ->setCreatedAt(new \DateTime)
            ->addCategory($categories[$faker->numberBetween(0,14)])
            ->setAuthor($users[$faker->numberBetween(0,49)]);
            $manager->persist($article);

            $articles[]=$article;
        }

        $manager->flush();
    }
}
