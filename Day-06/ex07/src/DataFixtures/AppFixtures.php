<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Vote;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $users = [];

        // Créer 10 utilisateurs avec ROLE_USER
        for ($i = 1; $i <= 10; $i++)
        {
            $user = new User();
            $user->setUsername("user$i");
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->hasher->hashPassword($user, "$i"));
            $user->setReputation(0);

            $manager->persist($user);
            $users[] = $user;
        }


        // Créer un administrateur
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin'));
        $admin->setReputation(0); // CORRECTION : on utilise bien $admin et non $user

        $manager->persist($admin);
        $users[] = $admin;

        $posts = [];

        // Créer 20 posts
        for ($i = 0; $i < 20; $i++)
        {
            $author = $faker->randomElement($users);

            $post = new Post();
            $post->setTitle($faker->sentence(5));
            $post->setContent($faker->paragraphs(3, true));
            $post->setCreated(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 month')));
            $post->setAuthor($author);
            $post->setLastEditedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 month')));
            $post->setLastEditedBy($faker->randomElement($users));

            $manager->persist($post);
            $posts[] = $post;
        }

        // Créer des votes aléatoires pour chaque post
        foreach ($posts as $post) {
            $voters = $faker->randomElements($users, mt_rand(1, 5));

            foreach ($voters as $voter) {
                if ($voter === $post->getAuthor()) {
                    continue; // un utilisateur ne vote pas pour son propre post
                }

                $vote = new Vote();
                $vote->setPost($post);
                $vote->setUser($voter);

                $isLike = $faker->boolean(70); // 70% de chances d'aimer
                $vote->setIsLike($isLike);

                // Mise à jour de la réputation
                if ($isLike) {
                    $post->getAuthor()?->increaseReputation(1);
                } else {
                    $post->getAuthor()?->decreaseReputation(1);
                }

                $manager->persist($vote);
            }
        }

        $manager->flush();
    }
}

