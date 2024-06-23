<?php
declare(strict_types=1);

namespace App\Entity\MemberShip;

use App\Entity\Common\EntityTrait;
use App\Entity\Common\IdentifierTrait;
use App\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class Group
 * @package App\Entity\MemberShip
 * @ORM\Table(name="member_ship_group")
 * @ORM\Entity(repositoryClass="App\Repository\MemberShip\GroupRepository")
 */
class Group implements EntityInterface
{
    use EntityTrait,
        IdentifierTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="text", nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="default_label", type="text", nullable=true)
     */
    private $defaultLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="default_description", type="text", nullable=true)
     */
    private $defaultDescription;

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