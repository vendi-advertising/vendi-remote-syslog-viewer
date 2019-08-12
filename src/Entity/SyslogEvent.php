<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SystemEvent
 *
 * @ORM\Table(name="systemevents")
 * @ORM\Entity(repositoryClass="App\Repository\SyslogEventRepository")
 */
class SyslogEvent
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="ID", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CustomerID", type="bigint", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $CustomerID;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ReceivedAt", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $ReceivedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DeviceReportedTime", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $DeviceReportedTime;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Facility", type="smallint", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $facility = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="Priority", type="smallint", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $Priority;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FromHost", type="string", length=60, precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $FromHost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Message", type="text", length=65535, precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $Message;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NTSeverity", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $NTSeverity;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Importance", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $Importance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EventSource", type="string", length=60, precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $EventSource;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EventUser", type="string", length=60, precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $EventUser;

    /**
     * @var int|null
     *
     * @ORM\Column(name="EventCategory", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $EventCategory;

    /**
     * @var int|null
     *
     * @ORM\Column(name="EventID", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $EventID;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EventBinaryData", type="text", length=65535, precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $EventBinaryData;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MaxAvailable", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $MaxAvailable;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CurrUsage", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $CurrUsage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MinUsage", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $MinUsage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MaxUsage", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $MaxUsage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="InfoUnitID", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $InfoUnitID;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SysLogTag", type="string", length=60, precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $SysLogTag;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EventLogType", type="string", length=60, precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $EventLogType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="GenericFileName", type="string", length=60, precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $GenericFileName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="SystemID", type="integer", precision=0, scale=0, nullable=true, options={"default"="NULL"}, unique=false)
     */
    private $SystemID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerID(): ?int
    {
        return $this->CustomerID;
    }

    public function setCustomerID(?int $CustomerID): self
    {
        $this->CustomerID = $CustomerID;

        return $this;
    }

    public function getReceivedAt(): ?\DateTimeInterface
    {
        return $this->ReceivedAt;
    }

    public function setReceivedAt(?\DateTimeInterface $ReceivedAt): self
    {
        $this->ReceivedAt = $ReceivedAt;

        return $this;
    }

    public function getDeviceReportedTime(): ?\DateTimeInterface
    {
        return $this->DeviceReportedTime;
    }

    public function setDeviceReportedTime(?\DateTimeInterface $DeviceReportedTime): self
    {
        $this->DeviceReportedTime = $DeviceReportedTime;

        return $this;
    }

    public function getFacility(): ?int
    {
        return $this->Facility;
    }

    public function setFacility(?int $Facility): self
    {
        $this->Facility = $Facility;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->Priority;
    }

    public function setPriority(?int $Priority): self
    {
        $this->Priority = $Priority;

        return $this;
    }

    public function getFromHost(): ?string
    {
        return $this->FromHost;
    }

    public function setFromHost(?string $FromHost): self
    {
        $this->FromHost = $FromHost;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(?string $Message): self
    {
        $this->Message = $Message;

        return $this;
    }

    public function getNTSeverity(): ?int
    {
        return $this->NTSeverity;
    }

    public function setNTSeverity(?int $NTSeverity): self
    {
        $this->NTSeverity = $NTSeverity;

        return $this;
    }

    public function getImportance(): ?int
    {
        return $this->Importance;
    }

    public function setImportance(?int $Importance): self
    {
        $this->Importance = $Importance;

        return $this;
    }

    public function getEventSource(): ?string
    {
        return $this->EventSource;
    }

    public function setEventSource(?string $EventSource): self
    {
        $this->EventSource = $EventSource;

        return $this;
    }

    public function getEventUser(): ?string
    {
        return $this->EventUser;
    }

    public function setEventUser(?string $EventUser): self
    {
        $this->EventUser = $EventUser;

        return $this;
    }

    public function getEventCategory(): ?int
    {
        return $this->EventCategory;
    }

    public function setEventCategory(?int $EventCategory): self
    {
        $this->EventCategory = $EventCategory;

        return $this;
    }

    public function getEventID(): ?int
    {
        return $this->EventID;
    }

    public function setEventID(?int $EventID): self
    {
        $this->EventID = $EventID;

        return $this;
    }

    public function getEventBinaryData(): ?string
    {
        return $this->EventBinaryData;
    }

    public function setEventBinaryData(?string $EventBinaryData): self
    {
        $this->EventBinaryData = $EventBinaryData;

        return $this;
    }

    public function getMaxAvailable(): ?int
    {
        return $this->MaxAvailable;
    }

    public function setMaxAvailable(?int $MaxAvailable): self
    {
        $this->MaxAvailable = $MaxAvailable;

        return $this;
    }

    public function getCurrUsage(): ?int
    {
        return $this->CurrUsage;
    }

    public function setCurrUsage(?int $CurrUsage): self
    {
        $this->CurrUsage = $CurrUsage;

        return $this;
    }

    public function getMinUsage(): ?int
    {
        return $this->MinUsage;
    }

    public function setMinUsage(?int $MinUsage): self
    {
        $this->MinUsage = $MinUsage;

        return $this;
    }

    public function getMaxUsage(): ?int
    {
        return $this->MaxUsage;
    }

    public function setMaxUsage(?int $MaxUsage): self
    {
        $this->MaxUsage = $MaxUsage;

        return $this;
    }

    public function getInfoUnitID(): ?int
    {
        return $this->InfoUnitID;
    }

    public function setInfoUnitID(?int $InfoUnitID): self
    {
        $this->InfoUnitID = $InfoUnitID;

        return $this;
    }

    public function getSysLogTag(): ?string
    {
        return $this->SysLogTag;
    }

    public function setSysLogTag(?string $SysLogTag): self
    {
        $this->SysLogTag = $SysLogTag;

        return $this;
    }

    public function getEventLogType(): ?string
    {
        return $this->EventLogType;
    }

    public function setEventLogType(?string $EventLogType): self
    {
        $this->EventLogType = $EventLogType;

        return $this;
    }

    public function getGenericFileName(): ?string
    {
        return $this->GenericFileName;
    }

    public function setGenericFileName(?string $GenericFileName): self
    {
        $this->GenericFileName = $GenericFileName;

        return $this;
    }

    public function getSystemID(): ?int
    {
        return $this->SystemID;
    }

    public function setSystemID(?int $SystemID): self
    {
        $this->SystemID = $SystemID;

        return $this;
    }
}
