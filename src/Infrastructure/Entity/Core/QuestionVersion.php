<?php
declare(strict_types=1);

namespace App\Entity\Core;

use App\Entity\Common\EntityTrait;
use App\Entity\Common\IdentifierTrait;
use App\Entity\Common\TimestampableTrait;
use App\Entity\EntityInterface;
use App\Entity\Security\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Question elementaire à une reponse unique
 * @ORM\Table(name="core_question_version",
 *     uniqueConstraints={
 *        @ORM\UniqueConstraint(name="question_version_unique",
 *            columns={"question_id", "reference_language_id"})
 *    }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Core\QuestionVersionRepository")
 * @UniqueEntity(
 *      fields={"question_id", "reference_language_id"},
 *      message="QuestionVersion for given question  and reference_language already exists in database."
 * )
 */
class QuestionVersion implements EntityInterface
{
    use EntityTrait,
        IdentifierTrait,
        TimestampableTrait;

    /**
     * @ORM\Column(name="code", type="string", length=64, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var Question
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Question", inversedBy="questionVersions")
     * @ORM\JoinColumn(name="question_id", nullable=false)
     */
    protected $question;

    /**
     * @var ReferenceLanguage
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\ReferenceLanguage")
     * @ORM\JoinColumn(name="reference_language_id", nullable=false)
     */
    protected $referenceLanguage;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\Security\User")
     * @ORM\JoinColumn(name="creator_id", nullable=true)
     */
    protected $creator;

    /**
     * QuestionVersion constructor.
     */
    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return QuestionVersion
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
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
     * @return QuestionVersion
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return Question
     */
    public function getQuestion(): Question
    {
        return $this->question;
    }

    /**
     * @param Question $question
     * @return QuestionVersion
     */
    public function setQuestion(Question $question): QuestionVersion
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return ReferenceLanguage
     */
    public function getReferenceLanguage(): ReferenceLanguage
    {
        return $this->referenceLanguage;
    }

    /**
     * @param ReferenceLanguage $referenceLanguage
     * @return QuestionVersion
     */
    public function setReferenceLanguage(ReferenceLanguage $referenceLanguage): QuestionVersion
    {
        $this->referenceLanguage = $referenceLanguage;
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
     * @return QuestionVersion
     */
    public function setCreator(User $creator): QuestionVersion
    {
        $this->creator = $creator;
        return $this;
    }


}
