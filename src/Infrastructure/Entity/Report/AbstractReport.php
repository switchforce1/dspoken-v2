<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Report;

use App\Infrastructure\Entity\Common\CodedTrait;
use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\Publishable;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\Core\Language;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractReport
{
    use TimestampableTrait,
        Publishable,
        EntityTrait,
        CodedTrait;
    /**
     * @var string
     * @ORM\Column(name="default_title", type="string", length=64, nullable=true)
     */
    private string $defaultTitle;

    /**
     * @var string
     * @ORM\Column(name="default_description", type="text", nullable=false)
     */
    private string $defaultDescription;

    public function __construct()
    {
        $this->isPublished = false;
        $this->code = Uuid::uuid4()->toString();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * @return string
     */
    public function getDefaultTitle(): ?string
    {
        return $this->defaultTitle;
    }

    /**
     * @param ?string $defaultTitle
     * @return AbstractReport
     */
    public function setDefaultTitle(?string $defaultTitle): AbstractReport
    {
        $this->defaultTitle = $defaultTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultDescription(): ?string
    {
        return $this->defaultDescription;
    }

    /**
     * @param ?string $defaultDescription
     * @return AbstractReport
     */
    public function setDefaultDescription(?string $defaultDescription): AbstractReport
    {
        $this->defaultDescription = $defaultDescription;
        return $this;
    }
}
