<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name_pt", type="string", length=45, nullable=false)
     */
    private $categoryNamePt;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name_en", type="string", length=45, nullable=false)
     */
    private $categoryNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name_es", type="string", length=45, nullable=false)
     */
    private $categoryNameEs;


    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set categoryNamePt
     *
     * @param string $categoryNamePt
     *
     * @return Category
     */
    public function setCategoryNamePt($categoryNamePt)
    {
        $this->categoryNamePt = $categoryNamePt;

        return $this;
    }

    /**
     * Get categoryNamePt
     *
     * @return string
     */
    public function getCategoryNamePt()
    {
        return $this->categoryNamePt;
    }

    /**
     * Set categoryNameEn
     *
     * @param string $categoryNameEn
     *
     * @return Category
     */
    public function setCategoryNameEn($categoryNameEn)
    {
        $this->categoryNameEn = $categoryNameEn;

        return $this;
    }

    /**
     * Get categoryNameEn
     *
     * @return string
     */
    public function getCategoryNameEn()
    {
        return $this->categoryNameEn;
    }

    /**
     * Set categoryNameEs
     *
     * @param string $categoryNameEs
     *
     * @return Category
     */
    public function setCategoryNameEs($categoryNameEs)
    {
        $this->categoryNameEs = $categoryNameEs;

        return $this;
    }

    /**
     * Get categoryNameEs
     *
     * @return string
     */
    public function getCategoryNameEs()
    {
        return $this->categoryNameEs;
    }
}
