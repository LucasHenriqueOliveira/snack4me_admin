<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity
 */
class Customer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="customer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $customerId;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_name", type="string", length=150, nullable=true)
     */
    private $customerName;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_email", type="string", length=100, nullable=true)
     */
    private $customerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_password", type="string", length=45, nullable=true)
     */
    private $customerPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_token", type="string", length=100, nullable=true)
     */
    private $customerToken;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_device_id", type="string", length=45, nullable=true)
     */
    private $customerDeviceId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="customer_registration_date", type="datetime", nullable=true)
     */
    private $customerRegistrationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_sin_valid", type="string", length=1, nullable=true)
     */
    private $customerSinValid = 'N';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="customer_valid_date", type="datetime", nullable=true)
     */
    private $customerValidDate;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_phone", type="string", length=20, nullable=true)
     */
    private $customerPhone;

    /**
     * @var integer
     *
     * @ORM\Column(name="customer_type", type="integer", nullable=true)
     */
    private $customerType = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="customer_update_password", type="datetime", nullable=true)
     */
    private $customerUpdatePassword;


    /**
     * Get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set customerName
     *
     * @param string $customerName
     *
     * @return Customer
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Get customerName
     *
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set customerEmail
     *
     * @param string $customerEmail
     *
     * @return Customer
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * Get customerEmail
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * Set customerPassword
     *
     * @param string $customerPassword
     *
     * @return Customer
     */
    public function setCustomerPassword($customerPassword)
    {
        $this->customerPassword = $customerPassword;

        return $this;
    }

    /**
     * Get customerPassword
     *
     * @return string
     */
    public function getCustomerPassword()
    {
        return $this->customerPassword;
    }

    /**
     * Set customerToken
     *
     * @param string $customerToken
     *
     * @return Customer
     */
    public function setCustomerToken($customerToken)
    {
        $this->customerToken = $customerToken;

        return $this;
    }

    /**
     * Get customerToken
     *
     * @return string
     */
    public function getCustomerToken()
    {
        return $this->customerToken;
    }

    /**
     * Set customerDeviceId
     *
     * @param string $customerDeviceId
     *
     * @return Customer
     */
    public function setCustomerDeviceId($customerDeviceId)
    {
        $this->customerDeviceId = $customerDeviceId;

        return $this;
    }

    /**
     * Get customerDeviceId
     *
     * @return string
     */
    public function getCustomerDeviceId()
    {
        return $this->customerDeviceId;
    }

    /**
     * Set customerRegistrationDate
     *
     * @param \DateTime $customerRegistrationDate
     *
     * @return Customer
     */
    public function setCustomerRegistrationDate($customerRegistrationDate)
    {
        $this->customerRegistrationDate = $customerRegistrationDate;

        return $this;
    }

    /**
     * Get customerRegistrationDate
     *
     * @return \DateTime
     */
    public function getCustomerRegistrationDate()
    {
        return $this->customerRegistrationDate;
    }

    /**
     * Set customerSinValid
     *
     * @param string $customerSinValid
     *
     * @return Customer
     */
    public function setCustomerSinValid($customerSinValid)
    {
        $this->customerSinValid = $customerSinValid;

        return $this;
    }

    /**
     * Get customerSinValid
     *
     * @return string
     */
    public function getCustomerSinValid()
    {
        return $this->customerSinValid;
    }

    /**
     * Set customerValidDate
     *
     * @param \DateTime $customerValidDate
     *
     * @return Customer
     */
    public function setCustomerValidDate($customerValidDate)
    {
        $this->customerValidDate = $customerValidDate;

        return $this;
    }

    /**
     * Get customerValidDate
     *
     * @return \DateTime
     */
    public function getCustomerValidDate()
    {
        return $this->customerValidDate;
    }

    /**
     * Set customerPhone
     *
     * @param string $customerPhone
     *
     * @return Customer
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * Get customerPhone
     *
     * @return string
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
     * Set customerType
     *
     * @param integer $customerType
     *
     * @return Customer
     */
    public function setCustomerType($customerType)
    {
        $this->customerType = $customerType;

        return $this;
    }

    /**
     * Get customerType
     *
     * @return integer
     */
    public function getCustomerType()
    {
        return $this->customerType;
    }

    /**
     * Set customerUpdatePassword
     *
     * @param \DateTime $customerUpdatePassword
     *
     * @return Customer
     */
    public function setCustomerUpdatePassword($customerUpdatePassword)
    {
        $this->customerUpdatePassword = $customerUpdatePassword;

        return $this;
    }

    /**
     * Get customerUpdatePassword
     *
     * @return \DateTime
     */
    public function getCustomerUpdatePassword()
    {
        return $this->customerUpdatePassword;
    }
}
