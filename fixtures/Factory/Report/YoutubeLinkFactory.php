<?php

namespace Fixtures\Factory\Report;

use App\Infrastructure\Entity\Report\YoutubeLink;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<YoutubeLink>
 */
final class YoutubeLinkFactory extends PersistentProxyObjectFactory
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
        return YoutubeLink::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'channelLink' => self::faker()->text(255),
            'code' => self::faker()->uuid(),
            'createdAt' => self::faker()->dateTime(),
            'defaultDescription' => self::faker()->text(),
            'defaultTitle' => self::faker()->text(64),
            'isPublished' => self::faker()->boolean(),
            'updatedAt' => self::faker()->dateTime(),
            'videoLink' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(YoutubeLink $youtubeLink): void {})
        ;
    }
}
