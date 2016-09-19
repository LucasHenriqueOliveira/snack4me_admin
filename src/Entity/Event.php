<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eventId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_name", type="string", length=45, nullable=false)
     */
    private $eventName;

    /**
     * @var string
     *
     * @ORM\Column(name="event_image", type="string", length=45, nullable=true)
     */
    private $eventImage;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_city_id", type="integer", nullable=false)
     */
    private $eventCityId;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="event_tax_service", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $eventTaxService;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_user_id", type="integer", nullable=false)
     */
    private $eventUserId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="event_sin_active", type="boolean", nullable=false)
     */
    private $eventSinActive = '1';


    /**
     * Get eventId
     *
     * @return integer
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set eventName
     *
     * @param string $eventName
     *
     * @return Event
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get eventName
     *
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set eventImage
     *
     * @param string $eventImage
     *
     * @return Event
     */
    public function setEventImage($eventImage)
    {
        $this->eventImage = $eventImage;

        return $this;
    }

    /**
     * Get eventImage
     *
     * @return string
     */
    public function getEventImage()
    {
        return $this->eventImage;
    }

    /**
     * Set eventCityId
     *
     * @param integer $eventCityId
     *
     * @return Event
     */
    public function setEventCityId($eventCityId)
    {
        $this->eventCityId = $eventCityId;

        return $this;
    }

    /**
     * Get eventCityId
     *
     * @return integer
     */
    public function getEventCityId()
    {
        return $this->eventCityId;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Event
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Event
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set eventTaxService
     *
     * @param string $eventTaxService
     *
     * @return Event
     */
    public function setEventTaxService($eventTaxService)
    {
        $this->eventTaxService = $eventTaxService;

        return $this;
    }

    /**
     * Get eventTaxService
     *
     * @return string
     */
    public function getEventTaxService()
    {
        return $this->eventTaxService;
    }

    /**
     * Set eventUserId
     *
     * @param integer $eventUserId
     *
     * @return Event
     */
    public function setEventUserId($eventUserId)
    {
        $this->eventUserId = $eventUserId;

        return $this;
    }

    /**
     * Get eventUserId
     *
     * @return integer
     */
    public function getEventUserId()
    {
        return $this->eventUserId;
    }

    /**
     * Set eventSinActive
     *
     * @param boolean $eventSinActive
     *
     * @return Event
     */
    public function setEventSinActive($eventSinActive)
    {
        $this->eventSinActive = $eventSinActive;

        return $this;
    }

    /**
     * Get eventSinActive
     *
     * @return boolean
     */
    public function getEventSinActive()
    {
        return $this->eventSinActive;
    }
}
