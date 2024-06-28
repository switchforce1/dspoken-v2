<?php

namespace Fixtures\Factory\Security;

use App\Infrastructure\Entity\Security\User;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<User>
 */
final class UserFactory extends PersistentProxyObjectFactory
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
        return User::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'apiToken' => self::faker()->text(),
            'code' => self::faker()->text(255),
            'confirmationToken' => self::faker()->text(),
            'email' => self::faker()->text(),
            'enableConfirmationToken' => self::faker()->text(),
            'enabled' => self::faker()->boolean(),
            'lastLogin' => self::faker()->dateTime(),
            'password' => self::faker()->text(),
            'passwordRequestedAt' => self::faker()->dateTime(),
            'resetPasswordToken' => self::faker()->text(),
            'roles' => [],
            'username' => self::faker()->text(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(User $user): void {})
        ;
    }
}
