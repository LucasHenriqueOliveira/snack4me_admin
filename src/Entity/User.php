<?php

namespace App\Entity;



/**
 * @Entity
 * @Table(name="user")
 */

class User
{

    /**
     * @Id
     * @Column(name="user_id", type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $userId;


    /**
     * @Column(name="user_name", type="string", length=45, nullable=false)
     */
    private $userName;

    /**
     * @Column(name="user_password", type="string", length=45, nullable=false)
     */
    private $userPassword;


    /**
     * @Column(name="user_active", type="boolean", nullable=false)
     */
    private $userActive = '1';

    /**
     * @Column("user_profile_id", type="integer", nullable=false)
     */
    private $userProfileId;

    /**
     * @Column(name="user_login_default", type="boolean", nullable=false)
     */
    private $userLoginDefault = '1';

    /**
     * @Column(name="user_id_activation", type="integer", nullable=true)
     */
    private $userIdActivation;

    /**
     * @Column(name="user_dth_activation", type="datetime", nullable=true)
     */
    private $userDthActivation;

    /**
     * @Column(name="user_id_deactivation", type="integer", nullable=true)
     */
    private $userIdDeactivation;

    /**
     * @Column(name="user_dth_deactivation", type="datetime", nullable=true)
     */
    private $userDthDeactivation;

    /**
     * @Column(name="user_dth_update", type="datetime", nullable=true)
     */
    private $userDthUpdate;

    /**
     * @Column(name="user_token", type="string", length=100, nullable=true)
     */
    private $userToken;

    /**
     * @Column(name="zone_dth_activation", type="string", length=100, nullable=true)
     */
    private $zoneDthActivation;


    /**
     * @Column(name="zone_dth_deactivation", type="string", length=100, nullable=true)
     */
    private $zoneDthDeactivation;


    /**
     * @Column(name="zone_dth_update", type="string", length=30, nullable=true)
     */
    private $zoneDthUpdate;



    public function __construct(\DateTime $userDthActivation, \DateTime $userDthDeactivation, \DateTime $userDthUpdate)
    {

        $this->userDthActivation = $userDthActivation;
        $this->zoneDthActivation = $userDthActivation->getTimeZone()->getName();

        $this->userDthDeactivation = $userDthDeactivation;
        $this->zoneDthDeactivation = $userDthDeactivation->getTimeZone()->getName();

        $this->userDthUpdate = $userDthUpdate;
        $this->zoneDthUpdate = $userDthUpdate->getTimeZone()->getName();
    }


    /**
     * @return mixed
     */


    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return User
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * @param mixed $userPassword
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserActive()
    {
        return $this->userActive;
    }

    /**
     * @param mixed $userActive
     * @return User
     */
    public function setUserActive($userActive)
    {
        $this->userActive = $userActive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserProfileId()
    {
        return $this->userProfileId;
    }

    /**
     * @param mixed $userProfileId
     * @return User
     */
    public function setUserProfileId($userProfileId)
    {
        $this->userProfileId = $userProfileId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserLoginDefault()
    {
        return $this->userLoginDefault;
    }

    /**
     * @param mixed $userLoginDefault
     * @return User
     */
    public function setUserLoginDefault($userLoginDefault)
    {
        $this->userLoginDefault = $userLoginDefault;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserIdActivation()
    {
        return $this->userIdActivation;
    }

    /**
     * @param mixed $userIdActivation
     * @return User
     */
    public function setUserIdActivation($userIdActivation)
    {
        $this->userIdActivation = $userIdActivation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserDthActivation()
    {

        return $this->userDthActivation->setTimeZone(new \DateTimeZone($this->zoneDthActivation));

    }

    /**
     * @param mixed $userDthActivation
     * @return User
     */
    public function setUserDthActivation($userDthActivation)
    {
        $this->userDthActivation = $userDthActivation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserIdDeactivation()
    {
        return $this->userIdDeactivation;
    }

    /**
     * @param mixed $userIdDeactivation
     * @return User
     */
    public function setUserIdDeactivation($userIdDeactivation)
    {
        $this->userIdDeactivation = $userIdDeactivation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserDthDeactivation()
    {
        $data = $this->userDthDeactivation->setTimeZone(new \DateTimeZone($this->zoneDthDeactivation));
        return $data->format('d-m-Y h:m:s');

    }

    /**
     * @param mixed $userDthDeactivation
     * @return User
     */
    public function setUserDthDeactivation($userDthDeactivation)
    {
        $this->userDthDeactivation = $userDthDeactivation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserDthUpdate()
    {
        return $this->userDthUpdate->setTimeZone(new \DateTimeZone($this->zoneDthUpdate));

    }

    /**
     * @param mixed $userDthUpdate
     * @return User
     */
    public function setUserDthUpdate($userDthUpdate)
    {
        $this->userDthUpdate = $userDthUpdate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserToken()
    {
        return $this->userToken;
    }

    /**
     * @param mixed $userToken
     * @return User
     */
    public function setUserToken($userToken)
    {
        $this->userToken = $userToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserDeviceId()
    {
        return $this->userDeviceId;
    }

    /**
     * @param mixed $userDeviceId
     * @return User
     */
    public function setUserDeviceId($userDeviceId)
    {
        $this->userDeviceId = $userDeviceId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZoneDthActivation()
    {
        return $this->zoneDthActivation;
    }

    /**
     * @param mixed $zoneDthActivation
     */
        public function setZoneDthActivation($zoneDthActivation)
        {
            $this->zoneDthActivation = $zoneDthActivation;
        }

    /**
     * @return mixed
     */
    public function getZoneDthDeactivation()
    {
        return $this->zoneDthDeactivation;
    }

    /**
     * @param mixed $zoneDthDeactivation
     */
    public function setZoneDthDeactivation($zoneDthDeactivation)
    {
        $this->zoneDthDeactivation = $zoneDthDeactivation;
    }

    /**
     * @return mixed
     */
    public function getZoneDthUpdate()
    {
        return $this->zoneDthUpdate;
    }

    /**
     * @param mixed $zoneDthUpdate
     */
    public function setZoneDthUpdate($zoneDthUpdate)
    {
        $this->zoneDthUpdate = $zoneDthUpdate;
    }



}
