<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Common;

use App\Infrastructure\Entity\EntityInterface;
use Doctrine\DBAL\Types\Types;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppFile
 * @package App\Infrastructure\Entity\Common
 */
#[ORM\Table(name: 'common_app_file')]
#[ORM\Entity(repositoryClass: \App\Repository\Common\AppFileRepository::class)]
class AppFile implements EntityInterface
{
    use EntityTrait,IdentifierTrait;

    // TYPES
    const TYPE_IMAGE = 'IMAGE';
    const TYPE_VIDEO = 'VIDEO';
    const TYPES = [
        self::TYPE_IMAGE,
        self::TYPE_VIDEO,
    ];
    // SECTION
    const SECTION_QUIZ = 'QUIZ';
    const SECTION_QUESTION = 'QUESTION';
    const SECTION_LANGUAGE = 'LANGUAGE';
    const SECTIONS = [
        self::SECTION_QUIZ,
        self::SECTION_QUESTION,
        self::SECTION_LANGUAGE
    ];

    /**
     * @var string
     */
    #[ORM\Column(name: 'code', type: 'string', length: 255, nullable: false, unique: true)]
    private string $code;

    /**
     * @var string
     */
    #[ORM\Column(name: 'full_name', type: 'string', length: 255, nullable: false)]
    private string $fullName;

    /**
     * @var string
     */
    #[ORM\Column(name: 'path', type: 'string', length: 255, nullable: false)]
    private string $path;

    /**
     * @var string
     */
    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: false)]
    private string $name;

    /**
     * @var string
     */
    #[ORM\Column(name: 'type', type: 'string', length: 255, nullable: false)]
    private string $type;

    /**
     * @var string
     */
    #[ORM\Column(name: 'extension', type: 'string', length: 255, nullable: false)]
    private string $extension;

    /**
     * @var string
     */
    #[ORM\Column(name: 'section', type: 'string', length: 255, nullable: false)]
    private string $section;

    /**
     * @var \DateTimeInterface
     */
    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    /**
     * AppFile constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->code = Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @param string|null $fullName
     * @return $this
     */
    public function setFullName(?string $fullName): AppFile
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     * @return $this
     */
    public function setPath(?string $path): AppFile
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): AppFile
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return $this
     * @throws \Exception
     */
    public function setType(?string $type): AppFile
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * @param string|null $extension
     * @return $this
     */
    public function setExtension(?string $extension): AppFile
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @return string
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * @param string $section
     * @return AppFile
     */
    public function setSection(string $section): AppFile
    {
        $this->section = $section;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return $this
     */
    public function setCreatedAt(?\DateTime $createdAt): AppFile
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }
}