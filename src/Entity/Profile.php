<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity
 */
class Profile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="profile_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $profileId;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_name", type="string", length=45, nullable=false)
     */
    private $profileName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="profile_active", type="boolean", nullable=false)
     */
    private $profileActive = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="profile_dth_activation", type="datetime", nullable=true)
     */
    private $profileDthActivation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="profile_dth_deactivation", type="datetime", nullable=true)
     */
    private $profileDthDeactivation;


    /**
     * Get profileId
     *
     * @return integer
     */
    public function getProfileId()
    {
        return $this->profileId;
    }

    /**
     * Set profileName
     *
     * @param string $profileName
     *
     * @return Profile
     */
    public function setProfileName($profileName)
    {
        $this->profileName = $profileName;

        return $this;
    }

    /**
     * Get profileName
     *
     * @return string
     */
    public function getProfileName()
    {
        return $this->profileName;
    }

    /**
     * Set profileActive
     *
     * @param boolean $profileActive
     *
     * @return Profile
     */
    public function setProfileActive($profileActive)
    {
        $this->profileActive = $profileActive;

        return $this;
    }

    /**
     * Get profileActive
     *
     * @return boolean
     */
    public function getProfileActive()
    {
        return $this->profileActive;
    }

    /**
     * Set profileDthActivation
     *
     * @param \DateTime $profileDthActivation
     *
     * @return Profile
     */
    public function setProfileDthActivation($profileDthActivation)
    {
        $this->profileDthActivation = $profileDthActivation;

        return $this;
    }

    /**
     * Get profileDthActivation
     *
     * @return \DateTime
     */
    public function getProfileDthActivation()
    {
        return $this->profileDthActivation;
    }

    /**
     * Set profileDthDeactivation
     *
     * @param \DateTime $profileDthDeactivation
     *
     * @return Profile
     */
    public function setProfileDthDeactivation($profileDthDeactivation)
    {
        $this->profileDthDeactivation = $profileDthDeactivation;

        return $this;
    }

    /**
     * Get profileDthDeactivation
     *
     * @return \DateTime
     */
    public function getProfileDthDeactivation()
    {
        return $this->profileDthDeactivation;
    }
}
