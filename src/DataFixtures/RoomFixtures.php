<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $category = new Category();
        $category->setName('Salle de réunion');
        $manager->persist($category);

        for ($i=1;$i<26;$i++){
            $room = new Room();
            $room->setCategory($category);
            $room->setName('Salle n°'.$i);
            $room->setCapacity(rand(6,25));
            $manager->persist($room);
        }


        $manager->flush();
    }
}
