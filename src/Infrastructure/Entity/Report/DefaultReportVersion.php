<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Report;

use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="report_default_report_version")
 * @ORM\Entity(repositoryClass="App\Repository\Report\DefaultReportVersionRepository")
 */
class DefaultReportVersion extends AbstractReportVersion implements EntityInterface
{
    use IdentifierTrait;

    /**
     * @var WebLink|null
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\Report\WebLink", inversedBy="defaultReportVersions")
     */
    private ?WebLink $webLink;

    /**
     * @var YoutubeLink|null
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\Report\YoutubeLink", inversedBy="defaultReportVersions")
     */
    private ?YoutubeLink $youtubeLink;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return WebLink|null
     */
    public function getWebLink(): ?WebLink
    {
        return $this->webLink;
    }

    /**
     * @param WebLink|null $webLink
     * @return DefaultReportVersion
     */
    public function setWebLink(?WebLink $webLink): self
    {
        $this->webLink = $webLink;
        return $this;
    }

    /**
     * @return YoutubeLink|null
     */
    public function getYoutubeLink(): ?YoutubeLink
    {
        return $this->youtubeLink;
    }

    /**
     * @param YoutubeLink|null $youtubeLink
     * @return DefaultReportVersion
     */
    public function setYoutubeLink(?YoutubeLink $youtubeLink): self
    {
        $this->youtubeLink = $youtubeLink;
        return $this;
    }
}
