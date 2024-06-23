<?php
declare(strict_types=1);

namespace App\Entity\Subscription;

use App\Entity\Common\IdentifierTrait;
use App\Entity\Common\TimestampableTrait;
use App\Entity\Core\Language;
use App\Entity\Security\User;
use App\Entity\Common\EntityTrait;
use App\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Subscription
 * @package App\Entity\Subscription
 * @ORM\Table(name="subscription_subscription", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="language_subscriber_unique", columns={"language_id", "subscriber_id"})
 * })
 *
 * @ORM\Entity(repositoryClass="App\Repository\Subscription\SubscriptionRepository")
 */
class Subscription implements EntityInterface
{
    use EntityTrait,
        IdentifierTrait,
        TimestampableTrait;

    /**
     * Code unique d'identification d'une souscription pourra etre utilisé dans un lien par mail
     *
     * @var string
     * @ORM\Column(name="code", type="string", length=255, nullable=false, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="request_message", type="text", nullable=true)
     */
    private $requestMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="response_message", type="text", nullable=true)
     */
    private $responseMessage;

    /**
     * Accepted by language creator
     * @var bool
     *
     * @ORM\Column(name="accepted", type="boolean", nullable=false)
     */
    private $accepted = false;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="accepted_at", nullable=true)
     */
    private $acceptedAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Security\User")
     * @ORM\JoinColumn(name="approved_by_id", referencedColumnName="id")
     */
    private $acceptedBy;

    /**
     * Approved by Admin
     * @var bool
     *
     * @ORM\Column(name="approved", type="boolean", nullable=false)
     */
    private $approved = false;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Security\User")
     * @ORM\JoinColumn(name="approved_by_id", referencedColumnName="id")
     */
    private $approvedBy;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="approved_at", nullable=true)
     */
    private $approvedAt;

    /**
     * Approve message by site team manager
     * @var string
     *
     * @ORM\Column(name="approve_message", type="text", nullable=true)
     */
    private $approveMessage;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Security\User")
     * @ORM\JoinColumn(name="subscriber_id", referencedColumnName="id")
     */
    private $subscriber;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;

    /**
     * Created by language creator of for language creator
     * @var bool
     *
     * @ORM\Column(name="for_owner", type="boolean", nullable=false)
     */
    private $forOwner = false;

    /**
     * Allow only viewing on language
     * @var bool
     *
     * @ORM\Column(name="for_viewer", type="boolean", nullable=false)
     */
    private $forViewer = false;

    /**
     * Allow edition on language
     * @var bool
     *
     * @ORM\Column(name="for_editor", type="boolean", nullable=false)
     */
    private $forEditor = false;


    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
        $this->acceptedAt = null;
        $this->approvedAt = null;
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
     * @return string
     */
    public function getRequestMessage(): ?string
    {
        return $this->requestMessage;
    }

    /**
     * @param string $requestMessage
     * @return Subscription
     */
    public function setRequestMessage(string $requestMessage): Subscription
    {
        $this->requestMessage = $requestMessage;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponseMessage(): ?string
    {
        return $this->responseMessage;
    }

    /**
     * @param string $responseMessage
     * @return Subscription
     */
    public function setResponseMessage(string $responseMessage): Subscription
    {
        $this->responseMessage = $responseMessage;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAccepted(): ?bool
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     * @return Subscription
     */
    public function setAccepted(bool $accepted): Subscription
    {
        $this->accepted = $accepted;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAcceptedAt(): ?\DateTime
    {
        return $this->acceptedAt;
    }

    /**
     * @param \DateTime $acceptedAt
     * @return Subscription
     */
    public function setAcceptedAt(\DateTime $acceptedAt): Subscription
    {
        $this->acceptedAt = $acceptedAt;
        return $this;
    }

    /**
     * @return User
     */
    public function getAcceptedBy(): ?User
    {
        return $this->acceptedBy;
    }

    /**
     * @param User $acceptedBy
     * @return Subscription
     */
    public function setAcceptedBy(User $acceptedBy): Subscription
    {
        $this->acceptedBy = $acceptedBy;
        return $this;
    }

    /**
     * @return bool
     */
    public function isApproved(): ?bool
    {
        return $this->approved;
    }

    /**
     * @param bool $approved
     * @return Subscription
     */
    public function setApproved(bool $approved): Subscription
    {
        $this->approved = $approved;
        return $this;
    }

    /**
     * @return User
     */
    public function getApprovedBy(): ?User
    {
        return $this->approvedBy;
    }

    /**
     * @param User $approvedBy
     * @return Subscription
     */
    public function setApprovedBy(User $approvedBy): Subscription
    {
        $this->approvedBy = $approvedBy;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getApprovedAt(): ?\DateTime
    {
        return $this->approvedAt;
    }

    /**
     * @param \DateTime $approvedAt
     * @return Subscription
     */
    public function setApprovedAt(\DateTime $approvedAt): Subscription
    {
        $this->approvedAt = $approvedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproveMessage(): ?string
    {
        return $this->approveMessage;
    }

    /**
     * @param string $approveMessage
     * @return Subscription
     */
    public function setApproveMessage(string $approveMessage): Subscription
    {
        $this->approveMessage = $approveMessage;
        return $this;
    }

    /**
     * @return User
     */
    public function getSubscriber(): ?User
    {
        return $this->subscriber;
    }

    /**
     * @param User $subscriber
     * @return Subscription
     */
    public function setSubscriber(User $subscriber): Subscription
    {
        $this->subscriber = $subscriber;
        return $this;
    }

    /**
     * @return Language
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    /**
     * @param Language $language
     * @return Subscription
     */
    public function setLanguage(Language $language): Subscription
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return bool
     */
    public function isForOwner(): ?bool
    {
        return $this->forOwner;
    }

    /**
     * @param bool $forOwner
     * @return Subscription
     */
    public function setForOwner(bool $forOwner): Subscription
    {
        $this->forOwner = $forOwner;
        return $this;
    }

    /**
     * @return bool
     */
    public function isForViewer(): ?bool
    {
        return $this->forViewer;
    }

    /**
     * @param bool $forViewer
     * @return Subscription
     */
    public function setForViewer(bool $forViewer): Subscription
    {
        $this->forViewer = $forViewer;
        return $this;
    }

    /**
     * @return bool
     */
    public function isForEditor(): ?bool
    {
        return $this->forEditor;
    }

    /**
     * @param bool $forEditor
     * @return Subscription
     */
    public function setForEditor(bool $forEditor): Subscription
    {
        $this->forEditor = $forEditor;
        return $this;
    }
}
