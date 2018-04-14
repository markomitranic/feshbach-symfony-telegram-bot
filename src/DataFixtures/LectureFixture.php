<?php

namespace App\DataFixtures;

use App\Entity\Lecture;
use App\Entity\Speaker;
use App\Repository\SpeakerRepository;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LectureFixture implements ORMFixtureInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        for ($i = 0; $i < 22; $i++) {

            /** @var SpeakerRepository $repository */
            $repository = $manager->getRepository('App:Speaker');

            /** @var Speaker $speaker */
            $speaker = $repository->find(rand(1, 18));

            $lecture = new Lecture();
            $lecture->setSpeaker($speaker);
            $lecture->setDate(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 days', '+1 days')));
            $lecture->setDescription($faker->text(250));
            $lecture->setPhotoUrl($faker->imageUrl(300, 300));
            $manager->persist($lecture);

        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            SpeakerFixture::class
        ];
    }
}