<?php

declare(strict_types=1);

namespace Fixtures\DataFixtures\Tag;

use Fixtures\DataFixtures\BaseFixture;
use App\Entity\Product;
use App\Infrastructure\Entity\Tag\TagVersion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Fixtures\DataFixtures\Core\ReferenceLanguageFixtures;
use Fixtures\Factory\Tag\TagVersionFactory;
use Doctrine\Persistence\ObjectManager;

class TagVersionFixtures extends BaseFixture
{
    public function load(ObjectManager $manager)
    {
        TagVersionFactory::createMany(40);
        // TagVersionFactory::new()
        //     ->instantiateWith(fn () => new TagVersion())
        //     ->many(40)
        // ;
    }

    public function create(array|callable $attributes = []): mixed
    {
        return new TagVersion();    
    }

    public function getDependencies()
    {
        return [
            ReferenceLanguageFixtures::class,
        ];
    }
}
