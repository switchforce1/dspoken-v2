<?php

namespace Fixtures\Factory\Tag;

use App\Infrastructure\Entity\Core\ReferenceLanguage;
use App\Infrastructure\Entity\Tag\TagVersion;
use Doctrine\ORM\EntityManagerInterface;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<TagVersion>
 */
final class TagVersionFactory extends PersistentObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public static function class(): string
    {
        return TagVersion::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        $referenceLanguageCode = self::faker()->randomElement(['fr', 'en']);
        return [
            'code' => self::faker()->uuid(),
            'description' => self::faker()->text(),
            'label' => self::faker()->text(255),
            'referenceLanguage' => $this->em->getRepository(ReferenceLanguage::class)->findOneBy(['code'=> $referenceLanguageCode]),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        $hello  = '';
        return $this
            ->afterInstantiate(function(TagVersion $tagVersion): void {
                
            })
        ;
    }
}
