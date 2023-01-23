<?php

namespace Terrificminds\CareerPageBuilder\Api\Data;

/**
 * @api
 * @since 100.0.2 */

interface ApplicationInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    public const ID = 'application_id';
    public const NAME = 'application_name';
    public const EMAIL = 'email';
    public const ADDRESS = 'address';
    public const EXPERIENCE = 'experience';
    public const PHONE_NUMBER = 'phone_number';
    public const COVER_LETTER = 'cover_letter';
    public const RESUME = 'resume';

    public const JOB_DESIGNATION = 'job_designation';

    public const ATTRIBUTES = [
        self::ID,
        self::NAME,
        self::EMAIL,
        self::ADDRESS,
        self::EXPERIENCE,
        self::PHONE_NUMBER,
        self::COVER_LETTER,
        self::RESUME,
        self::JOB_DESIGNATION
    ];

    /**
     *  Id
     *
     * @return int|null
     */
    public function getApplicationId();

    /**
     * Set  id
     *
     * @param int $id
     * @return $this
     */
    public function setApplicationId($id);

    /**
     * Customer name
     *
     * @return string|null
     */
    public function getApplicantName();

    /**
     * Set customer name
     *
     * @param string $name
     * @return $this
     */
    public function setApplicantName($name);
     /**
      * Customer email
      *
      * @return string|null
      */
    public function getEmail();

    /**
     * Set customer email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * Get Address
     *
     * @return string|null
     */
    public function getAddress();

      /**
       * Set Address
       *
       * @param string $address
       * @return $this
       */
    public function setAddress($address);

       /**
        * Get Experience
        *
        * @return int|null
        */
    public function getExperience();

      /**
       * Set Experience
       *
       * @param string $experience
       * @return $this
       */
    public function setExperience($experience);

       /**
        * Phone Number
        *
        * @return string|null
        */
    public function getPhoneNumber();

      /**
       * Set Phone Number
       *
       * @param string $phone
       * @return $this
       */
    public function setPhoneNumber($phone);
    
/**
 * Cover Letter
 *
 * @return string|null
 */
    public function getCoverLetter();

      /**
       * Set Cover Letter
       *
       * @param string $letter
       * @return $this
       */
    public function setCoverLetter($letter);

          /**
           * Job designation
           *
           * @return string|null
           */
    public function getJobDesignation();

    /**
     * Set job designation
     *
     * @param string $designation
     * @return $this
     */
    public function setJobDesignation($designation);

      /**
       * Resume
       *
       * @return string|null
       */
    public function getResume();

      /**
       * Set Resume
       *
       * @param string $resume
       * @return $this
       */
    public function setResume($resume);
}
