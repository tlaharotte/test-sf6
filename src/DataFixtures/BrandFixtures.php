<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture{
    public function load(ObjectManager $manager){
        
        $brand = new Brand();
        $brand->setName('Peugeot');
        $brand->setStatus(true);
        $manager->persist($brand);

        $brand = new Brand();
        $brand->setName('Citroën');
        $brand->setStatus(true);
        $manager->persist($brand);

        $brand = new Brand();
        $brand->setName('Renault');
        $brand->setStatus(true);
        $manager->persist($brand);

        $brand = new Brand();
        $brand->setName('Porsche');
        $brand->setStatus(true);
        $manager->persist($brand);

        $manager->flush();
    }
}