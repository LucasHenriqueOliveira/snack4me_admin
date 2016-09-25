<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="order", indexes={@ORM\Index(name="order_user_id_delivery", columns={"order_user_id_delivery"})})
 * @ORM\Entity
 */
class Order
{
    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_customer_id", type="integer", nullable=false)
     */
    private $orderCustomerId;

    /**
     * @var string
     *
     * @ORM\Column(name="order_customer_email", type="string", length=150, nullable=false)
     */
    private $orderCustomerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="order_tracking_number", type="string", length=100, nullable=false)
     */
    private $orderTrackingNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="datetime", nullable=false)
     */
    private $orderDate;

    /**
     * @var string
     *
     * @ORM\Column(name="order_apartment", type="string", length=55, nullable=true)
     */
    private $orderApartment;

    /**
     * @var string
     *
     * @ORM\Column(name="order_floor", type="string", length=50, nullable=false)
     */
    private $orderFloor;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_local_order_id", type="integer", nullable=true)
     */
    private $orderLocalOrderId;

    /**
     * @var string
     *
     * @ORM\Column(name="order_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $orderPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="order_price_discount", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $orderPriceDiscount;

    /**
     * @var string
     *
     * @ORM\Column(name="order_tax_service", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $orderTaxService;

    /**
     * @var string
     *
     * @ORM\Column(name="order_price_total", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $orderPriceTotal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="order_schedule", type="boolean", nullable=false)
     */
    private $orderSchedule = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_schedule_date", type="time", nullable=true)
     */
    private $orderScheduleDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_delivery_date", type="datetime", nullable=true)
     */
    private $orderDeliveryDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_coupon_id", type="integer", nullable=true)
     */
    private $orderCouponId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_event_id", type="integer", nullable=false)
     */
    private $orderEventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_status_id", type="integer", nullable=true)
     */
    private $orderStatusId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_user_id_delivery", type="integer", nullable=true)
     */
    private $orderUserIdDelivery;


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
     * Set orderCustomerId
     *
     * @param integer $orderCustomerId
     *
     * @return Order
     */
    public function setOrderCustomerId($orderCustomerId)
    {
        $this->orderCustomerId = $orderCustomerId;

        return $this;
    }

    /**
     * Get orderCustomerId
     *
     * @return integer
     */
    public function getOrderCustomerId()
    {
        return $this->orderCustomerId;
    }

    /**
     * Set orderCustomerEmail
     *
     * @param string $orderCustomerEmail
     *
     * @return Order
     */
    public function setOrderCustomerEmail($orderCustomerEmail)
    {
        $this->orderCustomerEmail = $orderCustomerEmail;

        return $this;
    }

    /**
     * Get orderCustomerEmail
     *
     * @return string
     */
    public function getOrderCustomerEmail()
    {
        return $this->orderCustomerEmail;
    }

    /**
     * Set orderTrackingNumber
     *
     * @param string $orderTrackingNumber
     *
     * @return Order
     */
    public function setOrderTrackingNumber($orderTrackingNumber)
    {
        $this->orderTrackingNumber = $orderTrackingNumber;

        return $this;
    }

    /**
     * Get orderTrackingNumber
     *
     * @return string
     */
    public function getOrderTrackingNumber()
    {
        return $this->orderTrackingNumber;
    }

    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     *
     * @return Order
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set orderApartment
     *
     * @param string $orderApartment
     *
     * @return Order
     */
    public function setOrderApartment($orderApartment)
    {
        $this->orderApartment = $orderApartment;

        return $this;
    }

    /**
     * Get orderApartment
     *
     * @return string
     */
    public function getOrderApartment()
    {
        return $this->orderApartment;
    }

    /**
     * Set orderFloor
     *
     * @param string $orderFloor
     *
     * @return Order
     */
    public function setOrderFloor($orderFloor)
    {
        $this->orderFloor = $orderFloor;

        return $this;
    }

    /**
     * Get orderFloor
     *
     * @return string
     */
    public function getOrderFloor()
    {
        return $this->orderFloor;
    }

    /**
     * Set orderLocalOrderId
     *
     * @param integer $orderLocalOrderId
     *
     * @return Order
     */
    public function setOrderLocalOrderId($orderLocalOrderId)
    {
        $this->orderLocalOrderId = $orderLocalOrderId;

        return $this;
    }

    /**
     * Get orderLocalOrderId
     *
     * @return integer
     */
    public function getOrderLocalOrderId()
    {
        return $this->orderLocalOrderId;
    }

    /**
     * Set orderPrice
     *
     * @param string $orderPrice
     *
     * @return Order
     */
    public function setOrderPrice($orderPrice)
    {
        $this->orderPrice = $orderPrice;

        return $this;
    }

    /**
     * Get orderPrice
     *
     * @return string
     */
    public function getOrderPrice()
    {
        return $this->orderPrice;
    }

    /**
     * Set orderPriceDiscount
     *
     * @param string $orderPriceDiscount
     *
     * @return Order
     */
    public function setOrderPriceDiscount($orderPriceDiscount)
    {
        $this->orderPriceDiscount = $orderPriceDiscount;

        return $this;
    }

    /**
     * Get orderPriceDiscount
     *
     * @return string
     */
    public function getOrderPriceDiscount()
    {
        return $this->orderPriceDiscount;
    }

    /**
     * Set orderTaxService
     *
     * @param string $orderTaxService
     *
     * @return Order
     */
    public function setOrderTaxService($orderTaxService)
    {
        $this->orderTaxService = $orderTaxService;

        return $this;
    }

    /**
     * Get orderTaxService
     *
     * @return string
     */
    public function getOrderTaxService()
    {
        return $this->orderTaxService;
    }

    /**
     * Set orderPriceTotal
     *
     * @param string $orderPriceTotal
     *
     * @return Order
     */
    public function setOrderPriceTotal($orderPriceTotal)
    {
        $this->orderPriceTotal = $orderPriceTotal;

        return $this;
    }

    /**
     * Get orderPriceTotal
     *
     * @return string
     */
    public function getOrderPriceTotal()
    {
        return $this->orderPriceTotal;
    }

    /**
     * Set orderSchedule
     *
     * @param boolean $orderSchedule
     *
     * @return Order
     */
    public function setOrderSchedule($orderSchedule)
    {
        $this->orderSchedule = $orderSchedule;

        return $this;
    }

    /**
     * Get orderSchedule
     *
     * @return boolean
     */
    public function getOrderSchedule()
    {
        return $this->orderSchedule;
    }

    /**
     * Set orderScheduleDate
     *
     * @param \DateTime $orderScheduleDate
     *
     * @return Order
     */
    public function setOrderScheduleDate($orderScheduleDate)
    {
        $this->orderScheduleDate = $orderScheduleDate;

        return $this;
    }

    /**
     * Get orderScheduleDate
     *
     * @return \DateTime
     */
    public function getOrderScheduleDate()
    {
        return $this->orderScheduleDate;
    }

    /**
     * Set orderDeliveryDate
     *
     * @param \DateTime $orderDeliveryDate
     *
     * @return Order
     */
    public function setOrderDeliveryDate($orderDeliveryDate)
    {
        $this->orderDeliveryDate = $orderDeliveryDate;

        return $this;
    }

    /**
     * Get orderDeliveryDate
     *
     * @return \DateTime
     */
    public function getOrderDeliveryDate()
    {
        return $this->orderDeliveryDate;
    }

    /**
     * Set orderCouponId
     *
     * @param integer $orderCouponId
     *
     * @return Order
     */
    public function setOrderCouponId($orderCouponId)
    {
        $this->orderCouponId = $orderCouponId;

        return $this;
    }

    /**
     * Get orderCouponId
     *
     * @return integer
     */
    public function getOrderCouponId()
    {
        return $this->orderCouponId;
    }

    /**
     * Set orderEventId
     *
     * @param integer $orderEventId
     *
     * @return Order
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
     * @return Order
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
     * Set orderUserIdDelivery
     *
     * @param integer $orderUserIdDelivery
     *
     * @return Order
     */
    public function setOrderUserIdDelivery($orderUserIdDelivery)
    {
        $this->orderUserIdDelivery = $orderUserIdDelivery;

        return $this;
    }

    /**
     * Get orderUserIdDelivery
     *
     * @return integer
     */
    public function getOrderUserIdDelivery()
    {
        return $this->orderUserIdDelivery;
    }
}
