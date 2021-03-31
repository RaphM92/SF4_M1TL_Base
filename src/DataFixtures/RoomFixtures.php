<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Room;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RoomFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setEmail('admin@test.fr');
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setAddress('9 rue des boulets');
        $user->setCity('Paris');
        $user->setCountry('France');
        $user->setPassword($this->encoder->encodePassword($user,"Admin"));
        $user->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);
        $manager->flush();


        $category = new Category();
        $category->setName('Salle de réunion');
        $manager->persist($category);

        for ($i=1;$i<26;$i++){
            $room = new Room();
            $room->setUser($user);
            $room->setCategory($category);
            $room->setName('Salle n°'.$i);
            $room->setCapacity(rand(6,25));
            $room->setCity('Paris');
            $room->setHasWifi(true);
            $room->setDescription('Lorem ipsum dolor sit amet');
            $manager->persist($room);
        }


        $manager->flush();
    }
}
