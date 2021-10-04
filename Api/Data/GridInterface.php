<?php

namespace Esparksinc\Survey\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const SURVEY_ID = 'survey_id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const EMAIL = 'email';
    const CONTENT = 'content';
    const UPDATE_TIME = 'update_time';
    const CREATED_AT = 'created_at';

   /**
    * Get EntityId.
    *
    * @return int
    */
    public function getSurveyId();

   /**
    * Set EntityId.
    */
    public function setSurveyId($surveyId);

   /**
    * Get Title.
    *
    * @return varchar
    */
    public function getFirstName();

   /**
    * Set Title.
    */
    public function setFirstName($firstName);

   /**
    * Get Content.
    *
    * @return varchar
    */
    public function getLastName();

   /**
    * Set Content.
    */
    public function setLastName($lastName);
   /**
    * Get UpdateTime.
    *
    * @return varchar
    */
    public function getUpdateTime();

   /**
    * Set UpdateTime.
    */
    public function setUpdateTime($updateTime);

   /**
    * Get CreatedAt.
    *
    * @return varchar
    */
    public function getCreatedAt();

   /**
    * Set CreatedAt.
    */
    public function setCreatedAt($createdAt);

    public function getEmail();

    public function setEmail($email);

    public function getContent();

    public function setContent($content);
}
