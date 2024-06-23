<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Analysis;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class Visit
 * @package App\Infrastructure\Entity\Analysis
 */
#[ORM\Table(name: 'analysis_visit')]
#[ORM\Entity(repositoryClass: \App\Repository\Analysis\VisitRepository::class)]
class Visit implements EntityInterface
{
    use IdentifierTrait,
        EntityTrait,
        TimestampableTrait;

    /**
     * Code unique d'identification
     *
     * @var string
     */
    #[ORM\Column(name: 'code', type: 'string', length: 255, nullable: false, unique: true)]
    private string $code;

    /**
     * Must be unique later or in unique group (session_id+created_at)
     * @var string
     */
    #[ORM\Column(name: 'session_id', type: 'string', length: 255, nullable: false, unique: false)]
    private string $sessionId;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_code', type: 'string', length: 255, nullable: true)]
    private ?string $userCode = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'token', type: 'string', length: 255, nullable: true)]
    private ?string $token = null;

    /**
     * Visit constructor.
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
     * @return Visit
     */
    public function setCode(string $code): Visit
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     * @return Visit
     */
    public function setSessionId(string $sessionId): Visit
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserCode(): string
    {
        return $this->userCode;
    }

    /**
     * @param string $userCode
     * @return Visit
     */
    public function setUserCode(string $userCode): Visit
    {
        $this->userCode = $userCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Visit
     */
    public function setToken(string $token): Visit
    {
        $this->token = $token;
        return $this;
    }
}
