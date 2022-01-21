<?php

namespace App\DataFixtures;

use App\Entity\Admin\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MemberFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $member = new Member();
        $member->setRoles(array('ROLE_ADMIN'));
        $member->setPassword($this->passwordEncoder->encodePassword($member, 'admin123'));
        $member->setEmail('contact@openpixl.fr');
        $member->setFirstName('admin');
        $member->setLastName('Dév');
        $manager->persist($member);
        $manager->flush();
    }
}
