<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Core;

use App\Infrastructure\Entity\Common\AppFile;
use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\Publishable;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\Common\WeightDisplayableTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Questionnaire (Lots de question)
 */
#[ORM\Table(name: 'core_quiz')]
#[ORM\Entity(repositoryClass: \App\Repository\Core\QuizRepository::class)]
class Quiz implements EntityInterface
{
    use EntityTrait,
        Publishable,
        WeightDisplayableTrait,
        TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * Code unique d'identification d'un quiz pourra etre utilisé dans un lien par mail
     * Necessite une factory
     *
     * @var string
     */
    #[ORM\Column(name: 'code', type: 'string', length: 255, nullable: false, unique: true)]
    private string $code;

    #[ORM\Column(type: 'string', name: 'label', length: 255, nullable: true)]
    private ?string $label = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'score', type: 'integer', length: 4, nullable: false, options: ['default' => 0])]
    private int $score = 0;

    /**
     * @var string
     */
    #[ORM\Column(type: 'text', length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: \App\Infrastructure\Entity\Core\Question::class, mappedBy: 'quiz')]
    private \Doctrine\Common\Collections\Collection $questions;

    /**
     * Need for display on form/list/web page/translation
     *
     * @var ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: \App\Infrastructure\Entity\Core\QuizVersion::class, mappedBy: 'quiz', cascade: ['persist', 'remove'])]
    private \Doctrine\Common\Collections\Collection $quizVersions;

    /**
     * @var AppFile
     */
    #[ORM\JoinColumn(name: 'app_file_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Common\AppFile::class, cascade: ['persist'])]
    private ?\App\Infrastructure\Entity\Common\AppFile $appFile = null;

    /**
     * @var boolean
     */
    #[ORM\Column(name: 'enabled', type: 'boolean', nullable: false)]
    private bool $enabled = false;

    /**
     * @var boolean
     */
    #[ORM\Column(name: 'is_default', type: 'boolean', nullable: false)]
    private bool $isDefault = false;

    /**
     * Quiz constructor.
     */
    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->quizVersions = new ArrayCollection();
        $this->code = Uuid::uuid4()->toString();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return Quiz
     */
    public function setLabel(?string $label)
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
     * @return Quiz
     */
    public function setDescription(string $description): Quiz
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getQuestions(): ?Collection
    {
        return $this->questions;
    }

    /**
     * @param ArrayCollection $questions
     * @return Quiz
     */
    public function setQuestions(ArrayCollection $questions): Quiz
    {
        $this->questions = $questions;
        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getQuizVersions(): ?Collection
    {
        return $this->quizVersions;
    }

    /**
     * @param Collection $quizVersions
     * @return Quiz
     */
    public function setQuizVersions(Collection $quizVersions): Quiz
    {
        $this->quizVersions = $quizVersions;
        return $this;
    }

    /**
     * @param QuizVersion $quizVersion
     * @return $this
     */
    public function addQuizVersion(QuizVersion $quizVersion): Quiz
    {
        if(!$this->quizVersions->contains($quizVersion)) {
            $quizVersion->setQuiz($this);
            $this->quizVersions->add($quizVersion);
        }

        return $this;
    }

    /**
     * @param QuizVersion $quizVersion
     * @return Quiz
     */
    public function removeQuizVersion(QuizVersion $quizVersion): Quiz
    {
        if($this->quizVersions->contains($quizVersion)) {
            $quizVersion->setQuiz(null);
            $this->quizVersions->removeElement($quizVersion);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Quiz
     */
    public function setEnabled(bool $enabled): Quiz
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault(bool $isDefault): void
    {
        $this->isDefault = $isDefault;
    }

    /**
     * @return AppFile|null
     */
    public function getAppFile(): ?AppFile
    {
        return $this->appFile;
    }

    /**
     * @param AppFile|null $appFile
     * @return $this
     */
    public function setAppFile(?AppFile $appFile): Quiz
    {
        $this->appFile = $appFile;
        return $this;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function isDefault(): ?bool
    {
        return $this->isDefault;
    }

    public function setDefault(bool $isDefault): static
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }
}
