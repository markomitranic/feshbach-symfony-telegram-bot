<?php
/**
 * Created by PhpStorm.
 * User: markomitranic
 * Date: 4/13/18
 * Time: 20:47
 */

namespace App\DataFixtures;


use App\Entity\Lecture;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LectureFixture implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        // create 20 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $lecture = new Lecture();
            $name = $faker->name();
            $lecture->setName($name);
            $lecture->setMetaName($name . ' - ' . $faker->sentence(2, true));
            $lecture->setDate(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 days', '+1 days')));
            $lecture->setDescription($faker->text(250));
            $lecture->setPhotoUrl($faker->imageUrl(300, 300));
            $manager->persist($lecture);
        }

        $manager->flush();
    }
}