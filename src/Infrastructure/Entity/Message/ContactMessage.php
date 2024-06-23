<?php
declare(strict_types=1);

namespace App\Entity\Message;

use App\Entity\Common\EntityTrait;
use App\Entity\Common\IdentifierTrait;
use App\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ContactMessage
 * @package App\Entity\Message
 * @ORM\Table(name="message_contact_message")
 * @ORM\Entity(repositoryClass="App\Repository\Message\ContactMessageRepository")
 */
class ContactMessage extends AbstractMessage implements EntityInterface
{
    use IdentifierTrait;
    use EntityTrait {
        toTinnyArray as private parentToTinyArray;
    }

    /**
     * @var string
     *
     * @ORM\Column (type="string", name="type", nullable=false)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column (type="boolean", name="waiting_for_answer", nullable=false)
     */
    private $waitingForAnswer;

    /**
     * ContactMessage constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->waitingForAnswer = false;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ContactMessage
     */
    public function setType(string $type): ContactMessage
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function isWaitingForAnswer(): ?bool
    {
        return $this->waitingForAnswer;
    }

    /**
     * @param bool $waitingForAnswer
     * @return ContactMessage
     */
    public function setWaitingForAnswer(bool $waitingForAnswer): ContactMessage
    {
        $this->waitingForAnswer = $waitingForAnswer;
        return $this;
    }

    /**
     * @return array
     */
    public function toTinnyArray()
    {
        $tinyData = $this->parentToTinyArray();
        $tinyData ['sender'] = $this->sender ? $this->sender->toTinnyArray() : null;
        $tinyData ['recipient'] = $this->recipient ? $this->recipient->toTinnyArray() : null;

        return $tinyData;
    }
}