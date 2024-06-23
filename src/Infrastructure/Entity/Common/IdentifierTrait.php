<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait EntityTrait
 * @package App\Infrastructure\Entity\Common
 */
trait IdentifierTrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
