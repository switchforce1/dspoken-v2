<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Core;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\EntityInterface;
use App\Infrastructure\Entity\Security\User;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Reponse à une question donnée par un membre
 * @ORM\Table(name="core_response_group")
 * @ORM\Entity(repositoryClass="App\Repository\Core\ResponseGroupRepository")
 */
class ResponseGroup implements EntityInterface
{
    use EntityTrait,
        IdentifierTrait,
        TimestampableTrait;

    /**
     * Code unique
     *
     * @var string
     * @ORM\Column(name="code", type="string", length=255, nullable=false, unique=true)
     */
    private $code;

    /**
     * @var Quiz
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\Core\Quiz")
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id", nullable=false)
     */
    private $quiz;

    /**
     * @var Language
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\Core\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id", nullable=false)
     */
    protected $language;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\Security\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * ResponseGroup constructor.
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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return ResponseGroup
     */
    public function setCode(string $code): ResponseGroup
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return ResponseGroup
     */
    public function setCreatedAt(\DateTime $createdAt): ResponseGroup
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return ResponseGroup
     */
    public function setUpdatedAt(\DateTime $updatedAt): ResponseGroup
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Quiz
     */
    public function getQuiz(): Quiz
    {
        return $this->quiz;
    }

    /**
     * @param Quiz $quiz
     * @return ResponseGroup
     */
    public function setQuiz(Quiz $quiz): ResponseGroup
    {
        $this->quiz = $quiz;
        return $this;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @param Language $language
     * @return ResponseGroup
     */
    public function setLanguage(Language $language): ResponseGroup
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return ResponseGroup
     */
    public function setUser(User $user): ResponseGroup
    {
        $this->user = $user;
        return $this;
    }
}
