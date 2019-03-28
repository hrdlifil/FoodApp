<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\JoinCOlumn(name="user_reported_id", referencedColumnName="user_id")
     */
    private $userReported;

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
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $offer;

    public function getReportId(): ?int
    {
        return $this->reportId;
    }

    /**
     * @return mixed
     */
    public function getUserReported()
    {
        return $this->userReported;
    }

    /**
     * @param mixed $userReported
     */
    public function setUserReported($userReported): void
    {
        $this->userReported = $userReported;
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * @param mixed $offer
     */
    public function setOffer($offer): void
    {
        $this->offer = $offer;
    }
}