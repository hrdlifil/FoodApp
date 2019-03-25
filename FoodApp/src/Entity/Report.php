<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReportRepository")
 * @ORM\Table(name="report")
 */
class Report
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()user
     * @ORM\Column(type="integer", name="report_id")
     */
    private $reportId;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinCOlumn(name="user_id", referencedColumnName="user_id")
     */
    private $userReportedId;

    /**
     * @ORM\Column(type="datetime", name="reported_at")
     */
    private $reportedAt;

    /**
     * @ORM\Column(type="report_type", name="report_type")
     */
    private $reportType;

    /**
     * @ORM\Column(type="string", name="what_for")
     */
    private $wharFor;

    /**
     * @ORM\OneToOne(targetEntity="Message")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="message_id")
     */
    private $messageId;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $offerId;

    public function getReportId(): ?int
    {
        return $this->reportId;
    }

    /**
     * @return mixed
     */
    public function getUserReportedId()
    {
        return $this->userReportedId;
    }

    /**
     * @param mixed $userReportedId
     */
    public function setUserReportedId($userReportedId): void
    {
        $this->userReportedId = $userReportedId;
    }

    /**
     * @return mixed
     */
    public function getReportedAt()
    {
        return $this->reportedAt;
    }

    /**
     * @param mixed $reportedAt
     */
    public function setReportedAt($reportedAt): void
    {
        $this->reportedAt = $reportedAt;
    }

    /**
     * @return mixed
     */
    public function getReportType()
    {
        return $this->reportType;
    }

    /**
     * @param mixed $reportType
     */
    public function setReportType($reportType): void
    {
        $this->reportType = $reportType;
    }

    /**
     * @return mixed
     */
    public function getWharFor()
    {
        return $this->wharFor;
    }

    /**
     * @param mixed $wharFor
     */
    public function setWharFor($wharFor): void
    {
        $this->wharFor = $wharFor;
    }

    /**
     * @return mixed
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param mixed $messageId
     */
    public function setMessageId($messageId): void
    {
        $this->messageId = $messageId;
    }

    /**
     * @return mixed
     */
    public function getOfferId()
    {
        return $this->offerId;
    }

    /**
     * @param mixed $offerId
     */
    public function setOfferId($offerId): void
    {
        $this->offerId = $offerId;
    }
}