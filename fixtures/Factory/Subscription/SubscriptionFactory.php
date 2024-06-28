<?php

namespace Fixtures\Factory\Subscription;

use App\Infrastructure\Entity\Subscription\Subscription;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Subscription>
 */
final class SubscriptionFactory extends PersistentProxyObjectFactory
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
        return Subscription::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'accepted' => self::faker()->boolean(),
            'acceptedAt' => self::faker()->dateTime(),
            'approveMessage' => self::faker()->text(),
            'approved' => self::faker()->boolean(),
            'approvedAt' => self::faker()->dateTime(),
            'code' => self::faker()->text(255),
            'createdAt' => self::faker()->dateTime(),
            'forEditor' => self::faker()->boolean(),
            'forOwner' => self::faker()->boolean(),
            'forViewer' => self::faker()->boolean(),
            'requestMessage' => self::faker()->text(),
            'responseMessage' => self::faker()->text(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Subscription $subscription): void {})
        ;
    }
}
