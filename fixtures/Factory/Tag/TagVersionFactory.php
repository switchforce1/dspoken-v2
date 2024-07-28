<?php

namespace Fixtures\Factory\Tag;

use App\Infrastructure\Entity\Core\ReferenceLanguage;
use App\Infrastructure\Entity\Tag\Tag;
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
        parent::__construct();
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
        $defaultLabel = self::faker()->randomElement(TagFactory::DEFAULT_LABELS);

        $tag = $this->em->getRepository(Tag::class)->findOneBy([
            'defaultLabel' => $defaultLabel
        ]);
        
        return [
            'code' => self::faker()->uuid(),
            'label' => self::faker()->text(255),
            'description' => self::faker()->text(),
            'referenceLanguage' => $this->em->getRepository(ReferenceLanguage::class)->findOneBy(['code'=> $referenceLanguageCode]),
            'tag' => $tag,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            ->afterInstantiate(function(TagVersion $tagVersion): void {
                
            })
        ;
    }
}
