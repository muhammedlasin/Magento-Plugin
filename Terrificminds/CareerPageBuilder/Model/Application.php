<?php
namespace  Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\Model\AbstractModel;
use Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface;

class Application extends AbstractModel implements ApplicationInterface
{
    /**
     * @var string
     */
    protected const CACHE_TAG = 'application_form';
    /**
     * @var string
     */
    protected $_cacheTag = 'application_form';

    /**
     * Construct function
     */
    protected function _construct()
    {
        $this->_init('Terrificminds\CareerPageBuilder\Model\ResourceModel\Application');
    }


    /**
     * @inheritDoc
     */
    public function getApplicationId()
    {
        return parent::getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setApplicationId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getApplicantName()
    {
        return parent::getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setApplicantName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return parent::getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }
     /**
      * @inheritDoc
      */
    public function getAddress()
    {
        return parent::getData(self::ADDRESS);
    }

    /**
     * @inheritDoc
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
      * @inheritDoc
      */
      public function getExperience()
      {
          return parent::getData(self::EXPERIENCE);
      }
  
      /**
       * @inheritDoc
       */
      public function setExperience($experience)
      {
          return $this->setData(self::EXPERIENCE, $experience);
      }

    /**
     * @inheritDoc
     */
    public function getPhoneNumber()
    {
        return parent::getData(self::PHONE_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setPhoneNumber($phone)
    {
        return $this->setData(self::PHONE_NUMBER, $phone);
    }

    /**
     * @inheritDoc
     */
    public function getCoverLetter()
    {
        return parent::getData(self::COVER_LETTER);
    }

    /**
     * @inheritDoc
     */
    public function setCoverLetter($letter)
    {
        return $this->setData(self::COVER_LETTER, $letter);
    }


        /**
     * @inheritDoc
     */
    public function getJobDesignation()
    {
        return parent::getData(self::JOB_DESIGNATION);
    }

       /**
     * @inheritDoc
     */
    public function setJobDesignation($designation)
    {
        return $this->setData(self::JOB_DESIGNATION, $designation);
    }

      /**
     * @inheritDoc
     */
    public function getResume()
    {
        return parent::getData(self::RESUME);
    }

    /**
     * @inheritDoc
     */
    public function setResume($resume)
    {
        return $this->setData(self::RESUME, $resume);
    }

  
   
}