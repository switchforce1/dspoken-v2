<?php

namespace Fixtures\Factory\Report;

use App\Infrastructure\Entity\Report\ReportSection;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<ReportSection>
 */
final class ReportSectionFactory extends PersistentProxyObjectFactory
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
        return ReportSection::class;
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
            'defaultContent' => self::faker()->text(65535),
            'defaultTitle' => self::faker()->text(255),
            'imageUrl' => self::faker()->text(255),
            'position' => self::faker()->randomNumber(),
            'templateCode' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(ReportSection $reportSection): void {})
        ;
    }
}
