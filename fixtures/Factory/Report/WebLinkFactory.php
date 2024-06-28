<?php

namespace Fixtures\Factory\Report;

use App\Infrastructure\Entity\Report\WebLink;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<WebLink>
 */
final class WebLinkFactory extends PersistentProxyObjectFactory
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
        return WebLink::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'code' => self::faker()->uuid(),
            'createdAt' => self::faker()->dateTime(),
            'defaultDescription' => self::faker()->text(),
            'defaultTitle' => self::faker()->text(64),
            'isPublished' => self::faker()->boolean(),
            'type' => self::faker()->text(255),
            'updatedAt' => self::faker()->dateTime(),
            'url' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(WebLink $webLink): void {})
        ;
    }
}
