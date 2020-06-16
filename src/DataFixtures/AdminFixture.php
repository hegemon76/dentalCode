<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Migrations\Version\Factory;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Doctor;
use App\Entity\Question;


class AdminFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setEmail('admin@admin.com');
        $user->setName('admin');
        $user->setSurname('admin');
        $user->setPhoneNumber('123123123');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($password);
        $manager->persist($user);


        for ($i = 0; $i < 10; $i++) {
            $question = new Question();
            $question->setName('test ' . $i);
            $question->setSurname('testNazwiska ' . $i);
            $question->setEmail('test@maila.pl ' . $i);
            $question->setBody('To ejst przykladowe pytanie ktore moze zdac uzytkownik do admina NR. ' . $i);
            $manager->persist($question);
        }

        for ($i = 0; $i < 5; $i++) {
        $doctor = new Doctor();
        $doctor->setName('Janusz '.$i);
        $doctor->setSurname('Jankowski '.$i);
        $doctor->setSpecialization('Specjalizator '.$i);
        $manager->persist($doctor);
        }
        $manager->flush();
    }
}
