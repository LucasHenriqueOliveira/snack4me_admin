<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * RateOrder
 *
 * @ORM\Table(name="rate_order")
 * @ORM\Entity
 */
class RateOrder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="rate_order_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rateOrderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate_order_order_id", type="integer", nullable=true)
     */
    private $rateOrderOrderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate_order_question_1", type="integer", nullable=true)
     */
    private $rateOrderQuestion1;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate_order_question_2", type="integer", nullable=true)
     */
    private $rateOrderQuestion2;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate_order_question_3", type="integer", nullable=true)
     */
    private $rateOrderQuestion3;

    /**
     * @var string
     *
     * @ORM\Column(name="rate_order_desc", type="text", length=65535, nullable=true)
     */
    private $rateOrderDesc;


    /**
     * Get rateOrderId
     *
     * @return integer
     */
    public function getRateOrderId()
    {
        return $this->rateOrderId;
    }

    /**
     * Set rateOrderOrderId
     *
     * @param integer $rateOrderOrderId
     *
     * @return RateOrder
     */
    public function setRateOrderOrderId($rateOrderOrderId)
    {
        $this->rateOrderOrderId = $rateOrderOrderId;

        return $this;
    }

    /**
     * Get rateOrderOrderId
     *
     * @return integer
     */
    public function getRateOrderOrderId()
    {
        return $this->rateOrderOrderId;
    }

    /**
     * Set rateOrderQuestion1
     *
     * @param integer $rateOrderQuestion1
     *
     * @return RateOrder
     */
    public function setRateOrderQuestion1($rateOrderQuestion1)
    {
        $this->rateOrderQuestion1 = $rateOrderQuestion1;

        return $this;
    }

    /**
     * Get rateOrderQuestion1
     *
     * @return integer
     */
    public function getRateOrderQuestion1()
    {
        return $this->rateOrderQuestion1;
    }

    /**
     * Set rateOrderQuestion2
     *
     * @param integer $rateOrderQuestion2
     *
     * @return RateOrder
     */
    public function setRateOrderQuestion2($rateOrderQuestion2)
    {
        $this->rateOrderQuestion2 = $rateOrderQuestion2;

        return $this;
    }

    /**
     * Get rateOrderQuestion2
     *
     * @return integer
     */
    public function getRateOrderQuestion2()
    {
        return $this->rateOrderQuestion2;
    }

    /**
     * Set rateOrderQuestion3
     *
     * @param integer $rateOrderQuestion3
     *
     * @return RateOrder
     */
    public function setRateOrderQuestion3($rateOrderQuestion3)
    {
        $this->rateOrderQuestion3 = $rateOrderQuestion3;

        return $this;
    }

    /**
     * Get rateOrderQuestion3
     *
     * @return integer
     */
    public function getRateOrderQuestion3()
    {
        return $this->rateOrderQuestion3;
    }

    /**
     * Set rateOrderDesc
     *
     * @param string $rateOrderDesc
     *
     * @return RateOrder
     */
    public function setRateOrderDesc($rateOrderDesc)
    {
        $this->rateOrderDesc = $rateOrderDesc;

        return $this;
    }

    /**
     * Get rateOrderDesc
     *
     * @return string
     */
    public function getRateOrderDesc()
    {
        return $this->rateOrderDesc;
    }
}
