<?php
declare(strict_types=1);

namespace App\Entity\Tag;

use App\Entity\Common\EntityTrait;
use App\Entity\Common\EntityVersion;
use App\Entity\Common\IdentifierTrait;
use App\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tag_tag_version")
 * @ORM\Entity(repositoryClass="App\Repository\Tag\TagVersionRepository")
 */
class TagVersion extends EntityVersion implements EntityInterface
{
    use IdentifierTrait, EntityTrait;
}