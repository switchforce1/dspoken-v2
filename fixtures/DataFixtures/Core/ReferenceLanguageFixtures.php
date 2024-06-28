<?php

declare(strict_types=1);

namespace Fixtures\DataFixtures\Core;

use App\Infrastructure\Entity\Core\ReferenceLanguage;
use Fixtures\DataFixtures\BaseFixture;
use Doctrine\Persistence\ObjectManager;

class ReferenceLanguageFixtures extends BaseFixture
{
    private const array REFERENCE_LANGUAGE = [
        'fr' => 'Français',
        'en' => 'English',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::REFERENCE_LANGUAGE as $languageCode => $languageLabel) {
            $manager->persist($this->getReferenceLanguage($languageCode));
        }

        $manager->flush();
    }

    private function getReferenceLanguage(string $languageCode): ReferenceLanguage
    {
        return (new ReferenceLanguage())
            ->setCode($languageCode)
            ->setLabel(self::REFERENCE_LANGUAGE[$languageCode])
            ->setEnabled(true)
            ->setIsDefault(('fr' === $languageCode))
        ;
    }
}
