<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\MemberShip;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class Group
 * @package App\Infrastructure\Entity\MemberShip
 */
#[ORM\Table(name: 'member_ship_group')]
#[ORM\Entity(repositoryClass: \App\Infrastructure\Repository\MemberShip\GroupRepository::class)]
class Group implements EntityInterface
{
    use EntityTrait,
        IdentifierTrait;

    /**
     * @var string
     */
    #[ORM\Column(name: 'code', type: 'text', nullable: true)]
    private ?string $code = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'default_label', type: 'text', nullable: true)]
    private ?string $defaultLabel = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'default_description', type: 'text', nullable: true)]
    private ?string $defaultDescription = null;

    /**
     * Group constructor.
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

    /**
     * @param string $code
     * @return Group
     */
    public function setCode(string $code): Group
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultLabel(): string
    {
        return $this->defaultLabel;
    }

    /**
     * @param string $defaultLabel
     * @return Group
     */
    public function setDefaultLabel(string $defaultLabel): Group
    {
        $this->defaultLabel = $defaultLabel;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultDescription(): string
    {
        return $this->defaultDescription;
    }

    /**
     * @param string $defaultDescription
     * @return Group
     */
    public function setDefaultDescription(string $defaultDescription): Group
    {
        $this->defaultDescription = $defaultDescription;
        return $this;
    }
}