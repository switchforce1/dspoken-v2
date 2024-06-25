<?php

declare(strict_types=1);

namespace Fixtures\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;

abstract class BaseFixture extends Fixture
{
    protected $faker;
}