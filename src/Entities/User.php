<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=45, nullable=false)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=45, nullable=false)
     */
    private $userPassword;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_active", type="boolean", nullable=false)
     */
    private $userActive = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="user_profile_id", type="integer", nullable=false)
     */
    private $userProfileId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_login_default", type="boolean", nullable=false)
     */
    private $userLoginDefault = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id_activation", type="integer", nullable=true)
     */
    private $userIdActivation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_dth_activation", type="datetime", nullable=true)
     */
    private $userDthActivation;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id_deactivation", type="integer", nullable=true)
     */
    private $userIdDeactivation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_dth_deactivation", type="datetime", nullable=true)
     */
    private $userDthDeactivation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_dth_update", type="datetime", nullable=true)
     */
    private $userDthUpdate;

    /**
     * @var string
     *
     * @ORM\Column(name="user_token", type="string", length=100, nullable=true)
     */
    private $userToken;

    /**
     * @var string
     *
     * @ORM\Column(name="user_device_id", type="string", length=100, nullable=true)
     */
    private $userDeviceId;


    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     *
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userActive
     *
     * @param boolean $userActive
     *
     * @return User
     */
    public function setUserActive($userActive)
    {
        $this->userActive = $userActive;

        return $this;
    }

    /**
     * Get userActive
     *
     * @return boolean
     */
    public function getUserActive()
    {
        return $this->userActive;
    }

    /**
     * Set userProfileId
     *
     * @param integer $userProfileId
     *
     * @return User
     */
    public function setUserProfileId($userProfileId)
    {
        $this->userProfileId = $userProfileId;

        return $this;
    }

    /**
     * Get userProfileId
     *
     * @return integer
     */
    public function getUserProfileId()
    {
        return $this->userProfileId;
    }

    /**
     * Set userLoginDefault
     *
     * @param boolean $userLoginDefault
     *
     * @return User
     */
    public function setUserLoginDefault($userLoginDefault)
    {
        $this->userLoginDefault = $userLoginDefault;

        return $this;
    }

    /**
     * Get userLoginDefault
     *
     * @return boolean
     */
    public function getUserLoginDefault()
    {
        return $this->userLoginDefault;
    }

    /**
     * Set userIdActivation
     *
     * @param integer $userIdActivation
     *
     * @return User
     */
    public function setUserIdActivation($userIdActivation)
    {
        $this->userIdActivation = $userIdActivation;

        return $this;
    }

    /**
     * Get userIdActivation
     *
     * @return integer
     */
    public function getUserIdActivation()
    {
        return $this->userIdActivation;
    }

    /**
     * Set userDthActivation
     *
     * @param \DateTime $userDthActivation
     *
     * @return User
     */
    public function setUserDthActivation($userDthActivation)
    {
        $this->userDthActivation = $userDthActivation;

        return $this;
    }

    /**
     * Get userDthActivation
     *
     * @return \DateTime
     */
    public function getUserDthActivation()
    {
        return $this->userDthActivation;
    }

    /**
     * Set userIdDeactivation
     *
     * @param integer $userIdDeactivation
     *
     * @return User
     */
    public function setUserIdDeactivation($userIdDeactivation)
    {
        $this->userIdDeactivation = $userIdDeactivation;

        return $this;
    }

    /**
     * Get userIdDeactivation
     *
     * @return integer
     */
    public function getUserIdDeactivation()
    {
        return $this->userIdDeactivation;
    }

    /**
     * Set userDthDeactivation
     *
     * @param \DateTime $userDthDeactivation
     *
     * @return User
     */
    public function setUserDthDeactivation($userDthDeactivation)
    {
        $this->userDthDeactivation = $userDthDeactivation;

        return $this;
    }

    /**
     * Get userDthDeactivation
     *
     * @return \DateTime
     */
    public function getUserDthDeactivation()
    {
        return $this->userDthDeactivation;
    }

    /**
     * Set userDthUpdate
     *
     * @param \DateTime $userDthUpdate
     *
     * @return User
     */
    public function setUserDthUpdate($userDthUpdate)
    {
        $this->userDthUpdate = $userDthUpdate;

        return $this;
    }

    /**
     * Get userDthUpdate
     *
     * @return \DateTime
     */
    public function getUserDthUpdate()
    {
        return $this->userDthUpdate;
    }

    /**
     * Set userToken
     *
     * @param string $userToken
     *
     * @return User
     */
    public function setUserToken($userToken)
    {
        $this->userToken = $userToken;

        return $this;
    }

    /**
     * Get userToken
     *
     * @return string
     */
    public function getUserToken()
    {
        return $this->userToken;
    }

    /**
     * Set userDeviceId
     *
     * @param string $userDeviceId
     *
     * @return User
     */
    public function setUserDeviceId($userDeviceId)
    {
        $this->userDeviceId = $userDeviceId;

        return $this;
    }

    /**
     * Get userDeviceId
     *
     * @return string
     */
    public function getUserDeviceId()
    {
        return $this->userDeviceId;
    }
}
