<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Core;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\EntityInterface;
use App\Infrastructure\Entity\Security\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Quiz elementaire à une reponse unique
 */
#[ORM\Table(name: 'core_quiz_version')]
#[ORM\UniqueConstraint(name: 'quiz_version_unique', columns: ['quiz_id', 'reference_language_id'])]
#[ORM\Entity(repositoryClass: \App\Infrastructure\Repository\Core\QuizVersionRepository::class)]
class QuizVersion implements EntityInterface
{
    use EntityTrait,
        IdentifierTrait,
        TimestampableTrait;

    /**
     * @var string
     */
    #[ORM\Column(name: 'code', type: 'string', length: 64, nullable: true)]
    private ?string $code = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'label', type: 'string', length: 255, nullable: true)]
    private ?string $label = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'description', type: 'text', nullable: true)]
    private ?string $description = null;

    /**
     * @var Quiz
     */
    #[ORM\JoinColumn(name: 'quiz_id', nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Core\Quiz::class, inversedBy: 'quizVersions')]
    protected ?\App\Infrastructure\Entity\Core\Quiz $quiz = null;

    /**
     * @var ReferenceLanguage
     */
    #[ORM\JoinColumn(name: 'reference_language_id', nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Core\ReferenceLanguage::class)]
    protected ?\App\Infrastructure\Entity\Core\ReferenceLanguage $referenceLanguage = null;

    /**
     * @var User
     */
    #[ORM\JoinColumn(name: 'creator_id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Security\User::class)]
    protected ?\App\Infrastructure\Entity\Security\User $creator = null;

    /**
     * QuizVersion constructor.
     */
    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return QuizVersion
     */
    public function setCode(string $code): QuizVersion
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return QuizVersion
     */
    public function setLabel(string $label): QuizVersion
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return QuizVersion
     */
    public function setDescription(string $description): QuizVersion
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Quiz
     */
    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    /**
     * @param Quiz|null $quiz
     * @return $this
     */
    public function setQuiz(?Quiz $quiz): QuizVersion
    {
        $this->quiz = $quiz;
        return $this;
    }

    /**
     * @return ReferenceLanguage
     */
    public function getReferenceLanguage(): ?ReferenceLanguage
    {
        return $this->referenceLanguage;
    }

    /**
     * @param ReferenceLanguage $referenceLanguage
     * @return QuizVersion
     */
    public function setReferenceLanguage(?ReferenceLanguage $referenceLanguage): QuizVersion
    {
        $this->referenceLanguage = $referenceLanguage;
        return $this;
    }

    /**
     * @return User
     */
    public function getCreator(): ?User
    {
        return $this->creator;
    }

    /**
     * @param User $creator
     * @return QuizVersion
     */
    public function setCreator(User $creator): QuizVersion
    {
        $this->creator = $creator;
        return $this;
    }
}
