<?php

namespace Fixtures\Factory\Core;

use App\Infrastructure\Entity\Core\Location;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Location>
 */
final class LocationFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Location::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'circumstances' => self::faker()->text(),
            'code' => self::faker()->text(255),
            'countryCode' => self::faker()->text(255),
            'createdAt' => self::faker()->dateTime(),
            'displayWeight' => self::faker()->randomNumber(),
            'extendedLength' => self::faker()->randomFloat(),
            'isMain' => self::faker()->boolean(),
            'label' => self::faker()->text(255),
            'latitude' => self::faker()->randomFloat(),
            'longitude' => self::faker()->randomFloat(),
            'people' => self::faker()->text(255),
            'raduis' => self::faker()->randomNumber(),
            'region' => self::faker()->text(255),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Location $location): void {})
        ;
    }
}
