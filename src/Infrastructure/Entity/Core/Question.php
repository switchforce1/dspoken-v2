<?php
declare(strict_types=1);

namespace App\Entity\Core;

use App\Entity\Common\EntityTrait;
use App\Entity\Common\Publishable;
use App\Entity\Common\TimestampableTrait;
use App\Entity\Common\WeightDisplayableTrait;
use App\Entity\EntityInterface;
use App\Entity\Security\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Question
 * @ORM\Table(name="core_question")
 * @ORM\Entity(repositoryClass="App\Repository\Core\QuestionRepository")
 */
class Question implements EntityInterface
{
    use EntityTrait,
        Publishable,
        WeightDisplayableTrait,
        TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Code unique
     *
     * @var string
     * @ORM\Column(name="code", type="string", length=255, nullable=false, unique=true)
     */
    private $code;

    /**
     * Default label when no question version exist for requested language
     *
     * @ORM\Column(name="default_label", type="string", length=255, nullable=true)
     */
    private $defaultLabel;

    /**
     * @var string
     * @ORM\Column(name="question_type_code", type="string", length=255, nullable=true)
     */
    private $questionTypeCode;

    /**
     * @var Quiz
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Quiz", inversedBy="questions")
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id")
     */
    private $quiz;

    /**
     * Need for display on form/list/web page/translation
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Core\QuestionVersion", mappedBy="question", cascade={"persist", "remove"})
     */
    private $questionVersions;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\Security\User")
     */
    protected $creator;

    /**
     * @var boolean
     * @ORM\Column(name="enabled", type="boolean", length=255, nullable=true)
     */
    protected $enabled = true;

    /**
     * Question constructor.
     */
    public function __construct()
    {
        $this->questionVersions = new ArrayCollection();
        $this->code = Uuid::uuid4()->toString();
        $this->isPublished = true;
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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Question
     */
    public function setCode(string $code): Question
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultLabel()
    {
        return $this->defaultLabel;
    }

    /**
     * @param mixed $defaultLabel
     * @return Question
     */
    public function setDefaultLabel($defaultLabel)
    {
        $this->defaultLabel = $defaultLabel;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuestionTypeCode(): ?string
    {
        return $this->questionTypeCode;
    }

    /**
     * @param string|null $questionTypeCode
     * @return Question
     */
    public function setQuestionTypeCode(?string $questionTypeCode): Question
    {
        $this->questionTypeCode = $questionTypeCode;
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
    public function setQuiz(?Quiz $quiz): Question
    {
        $this->quiz = $quiz;
        return $this;
    }

    /**
     * @return User
     */
    public function getCreator(): User
    {
        return $this->creator;
    }

    /**
     * @param User $creator
     * @return Question
     */
    public function setCreator(User $creator): Question
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Question
     */
    public function setEnabled(bool $enabled): Question
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getQuestionVersions(): Collection
    {
        return $this->questionVersions;
    }

    /**
     * @param ArrayCollection $questionVersions
     * @return Question
     */
    public function setQuestionVersions(ArrayCollection $questionVersions): Question
    {
        $this->questionVersions = $questionVersions;
        return $this;
    }

    public function addQuestionVersion(QuestionVersion $questionVersion): Question
    {
        if (!$this->questionVersions->contains($questionVersion)) {
            $this->questionVersions->add($questionVersion);
        }
        $questionVersion->setQuestion($this);

        return $this;
    }

    public function removeQuestionVersion(QuestionVersion $questionVersion): Question
    {
        if ($this->questionVersions->contains($questionVersion)) {
            $this->questionVersions->removeElement($questionVersion);
        }
        $questionVersion->setQuestion($this);

        return $this;
    }
}
