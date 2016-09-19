<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LogOrderStatus
 *
 * @ORM\Table(name="log_order_status")
 * @ORM\Entity
 */
class LogOrderStatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="log_order_status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $logOrderStatusId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=true)
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_event_id", type="integer", nullable=true)
     */
    private $orderEventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_status_id", type="integer", nullable=true)
     */
    private $orderStatusId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="log_order_status_date", type="datetime", nullable=true)
     */
    private $logOrderStatusDate;


    /**
     * Get logOrderStatusId
     *
     * @return integer
     */
    public function getLogOrderStatusId()
    {
        return $this->logOrderStatusId;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     *
     * @return LogOrderStatus
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set orderEventId
     *
     * @param integer $orderEventId
     *
     * @return LogOrderStatus
     */
    public function setOrderEventId($orderEventId)
    {
        $this->orderEventId = $orderEventId;

        return $this;
    }

    /**
     * Get orderEventId
     *
     * @return integer
     */
    public function getOrderEventId()
    {
        return $this->orderEventId;
    }

    /**
     * Set orderStatusId
     *
     * @param integer $orderStatusId
     *
     * @return LogOrderStatus
     */
    public function setOrderStatusId($orderStatusId)
    {
        $this->orderStatusId = $orderStatusId;

        return $this;
    }

    /**
     * Get orderStatusId
     *
     * @return integer
     */
    public function getOrderStatusId()
    {
        return $this->orderStatusId;
    }

    /**
     * Set logOrderStatusDate
     *
     * @param \DateTime $logOrderStatusDate
     *
     * @return LogOrderStatus
     */
    public function setLogOrderStatusDate($logOrderStatusDate)
    {
        $this->logOrderStatusDate = $logOrderStatusDate;

        return $this;
    }

    /**
     * Get logOrderStatusDate
     *
     * @return \DateTime
     */
    public function getLogOrderStatusDate()
    {
        return $this->logOrderStatusDate;
    }
}
