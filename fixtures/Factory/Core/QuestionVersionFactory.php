<?php

namespace Fixtures\Factory\Core;

use App\Infrastructure\Entity\Core\QuestionVersion;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<QuestionVersion>
 */
final class QuestionVersionFactory extends PersistentProxyObjectFactory
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
        return QuestionVersion::class;
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
            'label' => self::faker()->text(255),
            'question' => QuestionFactory::new(),
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
            // ->afterInstantiate(function(QuestionVersion $questionVersion): void {})
        ;
    }
}
