<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity
 */
class Item
{
    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $itemId;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_order_id", type="integer", nullable=false)
     */
    private $itemOrderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_product_id", type="integer", nullable=false)
     */
    private $itemProductId;

    /**
     * @var string
     *
     * @ORM\Column(name="item_price_unit", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $itemPriceUnit;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_quantity", type="integer", nullable=false)
     */
    private $itemQuantity;

    /**
     * @var string
     *
     * @ORM\Column(name="item_price_total", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $itemPriceTotal;


    /**
     * Get itemId
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set itemOrderId
     *
     * @param integer $itemOrderId
     *
     * @return Item
     */
    public function setItemOrderId($itemOrderId)
    {
        $this->itemOrderId = $itemOrderId;

        return $this;
    }

    /**
     * Get itemOrderId
     *
     * @return integer
     */
    public function getItemOrderId()
    {
        return $this->itemOrderId;
    }

    /**
     * Set itemProductId
     *
     * @param integer $itemProductId
     *
     * @return Item
     */
    public function setItemProductId($itemProductId)
    {
        $this->itemProductId = $itemProductId;

        return $this;
    }

    /**
     * Get itemProductId
     *
     * @return integer
     */
    public function getItemProductId()
    {
        return $this->itemProductId;
    }

    /**
     * Set itemPriceUnit
     *
     * @param string $itemPriceUnit
     *
     * @return Item
     */
    public function setItemPriceUnit($itemPriceUnit)
    {
        $this->itemPriceUnit = $itemPriceUnit;

        return $this;
    }

    /**
     * Get itemPriceUnit
     *
     * @return string
     */
    public function getItemPriceUnit()
    {
        return $this->itemPriceUnit;
    }

    /**
     * Set itemQuantity
     *
     * @param integer $itemQuantity
     *
     * @return Item
     */
    public function setItemQuantity($itemQuantity)
    {
        $this->itemQuantity = $itemQuantity;

        return $this;
    }

    /**
     * Get itemQuantity
     *
     * @return integer
     */
    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    /**
     * Set itemPriceTotal
     *
     * @param string $itemPriceTotal
     *
     * @return Item
     */
    public function setItemPriceTotal($itemPriceTotal)
    {
        $this->itemPriceTotal = $itemPriceTotal;

        return $this;
    }

    /**
     * Get itemPriceTotal
     *
     * @return string
     */
    public function getItemPriceTotal()
    {
        return $this->itemPriceTotal;
    }
}
