<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Common;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TimestampableTrait
 * @package App\Infrastructure\Entity\Common
 */
trait TimestampableTrait
{
    /**
     * @Gedmo\Timestampable(on="create")
     */
    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    protected ?\DateTimeInterface $createdAt = null;

    /**
     * @Gedmo\Timestampable(on="update")
     */
    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    protected ?\DateTimeInterface $updatedAt = null;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return TimestampableTrait
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return TimestampableTrait
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}