<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ItemTypeProduct
 *
 * @ORM\Table(name="item_type_product")
 * @ORM\Entity
 */
class ItemTypeProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="item_type_product_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $itemTypeProductId;

    /**
     * @var string
     *
     * @ORM\Column(name="item_type_product_desc", type="text", length=65535, nullable=true)
     */
    private $itemTypeProductDesc;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_type_product_item_id", type="integer", nullable=true)
     */
    private $itemTypeProductItemId;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_type_product_type_product_id", type="integer", nullable=true)
     */
    private $itemTypeProductTypeProductId;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_type_product_product_id", type="integer", nullable=false)
     */
    private $itemTypeProductProductId;


    /**
     * Get itemTypeProductId
     *
     * @return integer
     */
    public function getItemTypeProductId()
    {
        return $this->itemTypeProductId;
    }

    /**
     * Set itemTypeProductDesc
     *
     * @param string $itemTypeProductDesc
     *
     * @return ItemTypeProduct
     */
    public function setItemTypeProductDesc($itemTypeProductDesc)
    {
        $this->itemTypeProductDesc = $itemTypeProductDesc;

        return $this;
    }

    /**
     * Get itemTypeProductDesc
     *
     * @return string
     */
    public function getItemTypeProductDesc()
    {
        return $this->itemTypeProductDesc;
    }

    /**
     * Set itemTypeProductItemId
     *
     * @param integer $itemTypeProductItemId
     *
     * @return ItemTypeProduct
     */
    public function setItemTypeProductItemId($itemTypeProductItemId)
    {
        $this->itemTypeProductItemId = $itemTypeProductItemId;

        return $this;
    }

    /**
     * Get itemTypeProductItemId
     *
     * @return integer
     */
    public function getItemTypeProductItemId()
    {
        return $this->itemTypeProductItemId;
    }

    /**
     * Set itemTypeProductTypeProductId
     *
     * @param integer $itemTypeProductTypeProductId
     *
     * @return ItemTypeProduct
     */
    public function setItemTypeProductTypeProductId($itemTypeProductTypeProductId)
    {
        $this->itemTypeProductTypeProductId = $itemTypeProductTypeProductId;

        return $this;
    }

    /**
     * Get itemTypeProductTypeProductId
     *
     * @return integer
     */
    public function getItemTypeProductTypeProductId()
    {
        return $this->itemTypeProductTypeProductId;
    }

    /**
     * Set itemTypeProductProductId
     *
     * @param integer $itemTypeProductProductId
     *
     * @return ItemTypeProduct
     */
    public function setItemTypeProductProductId($itemTypeProductProductId)
    {
        $this->itemTypeProductProductId = $itemTypeProductProductId;

        return $this;
    }

    /**
     * Get itemTypeProductProductId
     *
     * @return integer
     */
    public function getItemTypeProductProductId()
    {
        return $this->itemTypeProductProductId;
    }
}
