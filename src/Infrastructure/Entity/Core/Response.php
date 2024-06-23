<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Core;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Reponse à une question données par un membre
 */
#[ORM\Table(name: 'core_response')]
#[ORM\UniqueConstraint(name: 'question_response_group_unique', columns: ['question_id', 'response_group_id'])]
#[ORM\Entity(repositoryClass: \App\Repository\Core\ResponseRepository::class)]
class Response implements EntityInterface
{
    use EntityTrait,
        TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'answer', type: 'string', length: 255, nullable: true)]
    private ?string $answer = null;

    /**
     * @var \DateTimeInterface
     */
    #[ORM\Column(name: 'datetime', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $datetime = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'version', type: 'integer', nullable: true)]
    private ?int $version = 1;

    /**
     * @var Question
     */
    #[ORM\JoinColumn(name: 'question_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Core\Question::class)]
    protected ?\App\Infrastructure\Entity\Core\Question $question = null;

    /**
     * @var ResponseGroup
     */
    #[ORM\JoinColumn(name: 'response_group_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Core\ResponseGroup::class)]
    private ?\App\Infrastructure\Entity\Core\ResponseGroup $responseGroup = null;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->datetime = new \DateTime();
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
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     * @return Response
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime(): \DateTime
    {
        return $this->datetime;
    }

    /**
     * @param \DateTime $datetime
     * @return Response
     */
    public function setDatetime(\DateTime $datetime): Response
    {
        $this->datetime = $datetime;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return Response
     */
    public function setVersion(int $version): Response
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return Question
     */
    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    /**
     * @param Question $question
     * @return Response
     */
    public function setQuestion(Question $question): Response
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return ResponseGroup
     */
    public function getResponseGroup(): ?ResponseGroup
    {
        return $this->responseGroup;
    }

    /**
     * @param ResponseGroup $responseGroup
     * @return Response
     */
    public function setResponseGroup(ResponseGroup $responseGroup): Response
    {
        $this->responseGroup = $responseGroup;
        return $this;
    }
}
