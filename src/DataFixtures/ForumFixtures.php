<?php

namespace App\DataFixtures;

use App\Entity\Thread;
use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ForumFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for($i=0;$i<=\mt_rand(5,15);$i++) {
            $thread = new Thread();
            $thread->setSubject($faker->sentence(\mt_rand(3,6)));
            $thread->setAuthor($faker->name());
            $thread->setEmail($faker->email());
            $thread->setDescription($faker->sentence(mt_rand(10,50)));
            $thread->setCreatedAt($faker->dateTime());
            
            $manager->persist($thread);

            for($j=0;$j<=\mt_rand(10,50);$j++) {
                $message = new Message();
                $message->setThread($thread);
                $message->setSubject($faker->sentence(\mt_rand(3,6)));
                $message->setAuthor($faker->name());
                $message->setBody($faker->sentence(mt_rand(10,50)));
                $message->setCreatedAt($faker->dateTime());
                $message->setEmail($faker->email());
                
                $manager->persist($message);
            }
        } 

        $manager->flush();
    }
}
