<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Help to add display weight attribute to entity,
 * This property is used to order items on the page using display_weight value
 * The default value is zero 0. The maximum value is 9999.
 * The first item displayed is the item with the greatest display_weight.
 * To get the functionality work well never change the default value and avoid using value greater than 100.
 */
trait WeightDisplayableTrait
{
    /**
     * @var int
     */
    #[ORM\Column(name: 'display_weight', type: 'integer', length: 4, nullable: false)]
    protected int $displayWeight = 0;

    public function getDisplayWeight(): ?int
    {
        return $this->displayWeight;
    }

    public function setDisplayWeight(?int $displayWeight)
    {
        $this->displayWeight = $displayWeight;
        return $this;
    }
}
