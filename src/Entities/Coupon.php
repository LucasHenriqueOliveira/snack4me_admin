<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Coupon
 *
 * @ORM\Table(name="coupon")
 * @ORM\Entity
 */
class Coupon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="coupon_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $couponId;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon_number", type="string", length=45, nullable=false)
     */
    private $couponNumber;

    /**
     * @var float
     *
     * @ORM\Column(name="coupon_tax", type="float", precision=10, scale=0, nullable=true)
     */
    private $couponTax;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon_sin_used", type="string", length=1, nullable=true)
     */
    private $couponSinUsed = 'N';

    /**
     * @var integer
     *
     * @ORM\Column(name="coupon_event_id", type="integer", nullable=true)
     */
    private $couponEventId;


    /**
     * Get couponId
     *
     * @return integer
     */
    public function getCouponId()
    {
        return $this->couponId;
    }

    /**
     * Set couponNumber
     *
     * @param string $couponNumber
     *
     * @return Coupon
     */
    public function setCouponNumber($couponNumber)
    {
        $this->couponNumber = $couponNumber;

        return $this;
    }

    /**
     * Get couponNumber
     *
     * @return string
     */
    public function getCouponNumber()
    {
        return $this->couponNumber;
    }

    /**
     * Set couponTax
     *
     * @param float $couponTax
     *
     * @return Coupon
     */
    public function setCouponTax($couponTax)
    {
        $this->couponTax = $couponTax;

        return $this;
    }

    /**
     * Get couponTax
     *
     * @return float
     */
    public function getCouponTax()
    {
        return $this->couponTax;
    }

    /**
     * Set couponSinUsed
     *
     * @param string $couponSinUsed
     *
     * @return Coupon
     */
    public function setCouponSinUsed($couponSinUsed)
    {
        $this->couponSinUsed = $couponSinUsed;

        return $this;
    }

    /**
     * Get couponSinUsed
     *
     * @return string
     */
    public function getCouponSinUsed()
    {
        return $this->couponSinUsed;
    }

    /**
     * Set couponEventId
     *
     * @param integer $couponEventId
     *
     * @return Coupon
     */
    public function setCouponEventId($couponEventId)
    {
        $this->couponEventId = $couponEventId;

        return $this;
    }

    /**
     * Get couponEventId
     *
     * @return integer
     */
    public function getCouponEventId()
    {
        return $this->couponEventId;
    }
}
