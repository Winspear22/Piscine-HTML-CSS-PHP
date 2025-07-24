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

        // Créer des utilisateurs (non admin)
        $users = [];
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setUsername("user$i");
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->hasher->hashPassword($user, "password$i"));
            $manager->persist($user);
            $users[] = $user;
        }

        // Créer l'admin
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'adminpass'));
        $manager->persist($admin);
        $users[] = $admin;

        // Créer des posts
        $posts = [];
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence(5));
            $post->setContent($faker->paragraphs(3, true));
            $post->setCreated(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 month')));
            $post->setAuthor($faker->randomElement($users));
            $post->setLastEditedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 month')));
            $post->setLastEditedBy($faker->randomElement($users));
            $manager->persist($post);
            $posts[] = $post;
        }

        // Créer des votes
        foreach ($posts as $post) {
            // Chaque post reçoit jusqu'à 5 votes
            $voters = $faker->randomElements($users, mt_rand(1, 5));
            foreach ($voters as $voter) {
                // Ne pas voter pour son propre post
                if ($voter === $post->getAuthor()) continue;

                $vote = new Vote();
                $vote->setPost($post);
                $vote->setUser($voter);
                $vote->setIsLike($faker->boolean(70)); // 70% de likes
                $manager->persist($vote);
            }
        }

        $manager->flush();
    }
}
