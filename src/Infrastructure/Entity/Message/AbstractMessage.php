<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Message;

use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\Security\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class Message
 * @package App\Infrastructure\Entity\Contact
 */
#[ORM\MappedSuperclass]
abstract class AbstractMessage
{
    use TimestampableTrait;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', name: 'code', nullable: false, unique: true)]
    protected string $code;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', name: 'title', nullable: false)]
    protected string $title;

    /**
     * @var string
     */
    #[ORM\Column(name: 'content', type: 'text', nullable: false)]
    protected string $content;

    /**
     * @var User
     */
    #[ORM\JoinColumn(name: 'sender_id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Security\User::class)]
    protected ?\App\Infrastructure\Entity\Security\User $sender = null;

    /**
     * @var User
     */
    #[ORM\JoinColumn(name: 'recipient_id', referencedColumnName: 'id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Security\User::class)]
    protected ?\App\Infrastructure\Entity\Security\User $recipient = null;

    /**
     * AbstractMessage constructor.
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
     * @return AbstractMessage
     */
    public function setCode(string $code): AbstractMessage
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return AbstractMessage
     */
    public function setTitle(string $title): AbstractMessage
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return AbstractMessage
     */
    public function setContent(string $content): AbstractMessage
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return User
     */
    public function getSender(): ?User
    {
        return $this->sender;
    }

    /**
     * @param User $sender
     * @return AbstractMessage
     */
    public function setSender(User $sender): AbstractMessage
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return User
     */
    public function getRecipient(): ?User
    {
        return $this->recipient;
    }

    /**
     * @param User $recipient
     * @return AbstractMessage
     */
    public function setRecipient(User $recipient): AbstractMessage
    {
        $this->recipient = $recipient;
        return $this;
    }
}