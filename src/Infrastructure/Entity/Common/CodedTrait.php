<?php
declare(strict_types=1);

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Trait EntityTrait
 * @package App\Entity\Common
 */
trait CodedTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=64, nullable=true)
     */
    protected $code;

    /**
     * EntityVersion constructor.
     */
    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
}
