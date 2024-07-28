<?php

declare(strict_types=1);

namespace Fixtures\DataFixtures\Tag;

use Fixtures\DataFixtures\BaseFixture;
use App\Entity\Product;
use App\Infrastructure\Entity\Tag\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Fixtures\Factory\Tag\TagFactory;

class TagFixtures extends BaseFixture
{
    public function load(ObjectManager $manager)
    {
        foreach(TagFactory::DEFAULT_LABELS as $defaultLabel) {
            TagFactory::createOne(['defaultLabel' => $defaultLabel]);
        }
    }

    public function create(array|callable $attributes = []): mixed
    {
        return new Tag();    
    }
}
