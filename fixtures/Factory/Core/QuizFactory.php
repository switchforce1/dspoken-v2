<?php

namespace Fixtures\Factory\Core;

use App\Infrastructure\Entity\Core\Quiz;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Quiz>
 */
final class QuizFactory extends PersistentProxyObjectFactory
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
        return Quiz::class;
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
            'createdAt' => self::faker()->dateTime(),
            'description' => self::faker()->text(255),
            'displayWeight' => self::faker()->randomNumber(),
            'enabled' => self::faker()->boolean(),
            'isDefault' => self::faker()->boolean(),
            'isPublished' => self::faker()->boolean(),
            'label' => self::faker()->text(255),
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
            // ->afterInstantiate(function(Quiz $quiz): void {})
        ;
    }
}
