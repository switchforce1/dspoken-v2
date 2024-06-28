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
        TagFactory::new()
            // ->instantiateWith(fn () => new Tag())
            ->many(40)
        ;
        // // dd($tag);
        // TagFactory::createMany(40);
    }

    public function create(array|callable $attributes = []): mixed
    {
        return new Tag();    
    }
}
