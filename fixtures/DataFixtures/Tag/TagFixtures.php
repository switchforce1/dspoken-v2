<?php

declare(strict_types=1);

namespace Fixtures\DataFixtures\Tag;

use Fixtures\DataFixtures\BaseFixture;
use App\Entity\Product;
use App\Infrastructure\Entity\Tag\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends BaseFixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $tag = new Tag();
            $tag
                ->setDefaultLabel('tag-label_ '.$i)
                ->setDefaultDescription('Descriptions of label - '. $i);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}
