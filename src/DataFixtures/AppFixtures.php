<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Subject;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     *
     * @var [UserPasswordEncoderInterface]
     */
    private $passwordEncoder;

    /**
     *
     *
     * @var [type]
     */
    private $faker;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->faker = Factory::create();
    }
    public function load(ObjectManager $manager): void
    {

        $this->loadUsers($manager);
        $this->loadSubject($manager);

        $manager->flush();
    }

    public function loadSubject(ObjectManager $manager)
    {
        $user = $this->getReference('subject_tutor');
        $subject = new Subject();
        $subject->setName("English");
        $subject->setSlug("english");
        $subject->setDuration(3);

        $subject->setTutorId($user);

        $manager->persist($subject);

        $subject = new Subject();
        $subject->setName("English");
        $subject->setSlug("english");
        $subject->setDuration(3);

        $subject->setTutorId($user);

        $manager->persist($subject);

        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('english.tutor1@mail.com');
        $user->setUsername('englisht1');
        $user->setType('teacher');
        $user->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        $user->setName('Teacher Jones');

        $this->addReference('subject_tutor', $user);

        $manager->persist($user);

        $manager->flush();
    }
}
