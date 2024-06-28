<?php

namespace Fixtures\Factory\Core;

use App\Infrastructure\Entity\Core\QuizVersion;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<QuizVersion>
 */
final class QuizVersionFactory extends PersistentProxyObjectFactory
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
        return QuizVersion::class;
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
            'description' => self::faker()->text(),
            'label' => self::faker()->text(255),
            'quiz' => QuizFactory::new(),
            'referenceLanguage' => ReferenceLanguageFactory::new(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(QuizVersion $quizVersion): void {})
        ;
    }
}
