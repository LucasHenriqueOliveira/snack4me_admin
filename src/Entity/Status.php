<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity
 */
class Status
{
    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $statusId;

    /**
     * @var string
     *
     * @ORM\Column(name="status_name_pt", type="string", length=45, nullable=false)
     */
    private $statusNamePt;

    /**
     * @var string
     *
     * @ORM\Column(name="status_name_en", type="string", length=45, nullable=false)
     */
    private $statusNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="status_name_es", type="string", length=45, nullable=false)
     */
    private $statusNameEs;


    /**
     * Get statusId
     *
     * @return integer
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set statusNamePt
     *
     * @param string $statusNamePt
     *
     * @return Status
     */
    public function setStatusNamePt($statusNamePt)
    {
        $this->statusNamePt = $statusNamePt;

        return $this;
    }

    /**
     * Get statusNamePt
     *
     * @return string
     */
    public function getStatusNamePt()
    {
        return $this->statusNamePt;
    }

    /**
     * Set statusNameEn
     *
     * @param string $statusNameEn
     *
     * @return Status
     */
    public function setStatusNameEn($statusNameEn)
    {
        $this->statusNameEn = $statusNameEn;

        return $this;
    }

    /**
     * Get statusNameEn
     *
     * @return string
     */
    public function getStatusNameEn()
    {
        return $this->statusNameEn;
    }

    /**
     * Set statusNameEs
     *
     * @param string $statusNameEs
     *
     * @return Status
     */
    public function setStatusNameEs($statusNameEs)
    {
        $this->statusNameEs = $statusNameEs;

        return $this;
    }

    /**
     * Get statusNameEs
     *
     * @return string
     */
    public function getStatusNameEs()
    {
        return $this->statusNameEs;
    }
}
