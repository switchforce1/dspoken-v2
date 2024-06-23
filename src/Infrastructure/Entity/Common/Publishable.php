<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

trait Publishable
{
    /**
     * @var bool
     * @ORM\Column(name="is_published", type="boolean", options={"default" : 0})
     */
    protected $isPublished;

    /**
     * @return bool
     */
    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    /**
     * @param bool $isPublished
     * @return Publishable
     */
    public function setIsPublished(?bool $isPublished)
    {
        $this->isPublished = $isPublished;
        return $this;
    }
}
