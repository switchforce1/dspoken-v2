<?php

namespace Fixtures\Factory\Core;

use App\Infrastructure\Entity\Core\Language;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Language>
 */
final class LanguageFactory extends PersistentProxyObjectFactory
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
        return Language::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'code' => self::faker()->text(255),
            'countryCode' => self::faker()->text(255),
            'createdAt' => self::faker()->dateTime(),
            'description' => self::faker()->text(16777215),
            'displayWeight' => self::faker()->randomNumber(),
            'isPublished' => self::faker()->boolean(),
            'label' => self::faker()->text(255),
            'people' => self::faker()->text(255),
            'region' => self::faker()->text(255),
            'score' => self::faker()->randomNumber(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Language $language): void {})
        ;
    }
}
