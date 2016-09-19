<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LocalOrder
 *
 * @ORM\Table(name="local_order")
 * @ORM\Entity
 */
class LocalOrder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="local_order_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $localOrderId;

    /**
     * @var string
     *
     * @ORM\Column(name="local_order_name_pt", type="string", length=50, nullable=true)
     */
    private $localOrderNamePt;

    /**
     * @var string
     *
     * @ORM\Column(name="local_order_name_en", type="string", length=50, nullable=true)
     */
    private $localOrderNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="local_order_name_es", type="string", length=50, nullable=true)
     */
    private $localOrderNameEs;

    /**
     * @var integer
     *
     * @ORM\Column(name="local_order_event_id", type="integer", nullable=true)
     */
    private $localOrderEventId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="local_order_active", type="boolean", nullable=true)
     */
    private $localOrderActive = '1';


    /**
     * Get localOrderId
     *
     * @return integer
     */
    public function getLocalOrderId()
    {
        return $this->localOrderId;
    }

    /**
     * Set localOrderNamePt
     *
     * @param string $localOrderNamePt
     *
     * @return LocalOrder
     */
    public function setLocalOrderNamePt($localOrderNamePt)
    {
        $this->localOrderNamePt = $localOrderNamePt;

        return $this;
    }

    /**
     * Get localOrderNamePt
     *
     * @return string
     */
    public function getLocalOrderNamePt()
    {
        return $this->localOrderNamePt;
    }

    /**
     * Set localOrderNameEn
     *
     * @param string $localOrderNameEn
     *
     * @return LocalOrder
     */
    public function setLocalOrderNameEn($localOrderNameEn)
    {
        $this->localOrderNameEn = $localOrderNameEn;

        return $this;
    }

    /**
     * Get localOrderNameEn
     *
     * @return string
     */
    public function getLocalOrderNameEn()
    {
        return $this->localOrderNameEn;
    }

    /**
     * Set localOrderNameEs
     *
     * @param string $localOrderNameEs
     *
     * @return LocalOrder
     */
    public function setLocalOrderNameEs($localOrderNameEs)
    {
        $this->localOrderNameEs = $localOrderNameEs;

        return $this;
    }

    /**
     * Get localOrderNameEs
     *
     * @return string
     */
    public function getLocalOrderNameEs()
    {
        return $this->localOrderNameEs;
    }

    /**
     * Set localOrderEventId
     *
     * @param integer $localOrderEventId
     *
     * @return LocalOrder
     */
    public function setLocalOrderEventId($localOrderEventId)
    {
        $this->localOrderEventId = $localOrderEventId;

        return $this;
    }

    /**
     * Get localOrderEventId
     *
     * @return integer
     */
    public function getLocalOrderEventId()
    {
        return $this->localOrderEventId;
    }

    /**
     * Set localOrderActive
     *
     * @param boolean $localOrderActive
     *
     * @return LocalOrder
     */
    public function setLocalOrderActive($localOrderActive)
    {
        $this->localOrderActive = $localOrderActive;

        return $this;
    }

    /**
     * Get localOrderActive
     *
     * @return boolean
     */
    public function getLocalOrderActive()
    {
        return $this->localOrderActive;
    }
}
