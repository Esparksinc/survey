<?php

namespace Esparksinc\Survey\Model;

use Esparksinc\Survey\Api\Data\GridInterface;

class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'esparksinc_survey_form';

    /**
     * @var string
     */
    protected $_cacheTag = 'esparksinc_survey_form';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'esparksinc_survey_form';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Esparksinc\Survey\Model\ResourceModel\Grid');
    }
    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getSurveyId()
    {
        return $this->getData(self::SURVEY_ID);
    }

    /**
     * Set EntityId.
     */
    public function setSurveyId($surveyId)
    {
        return $this->setData(self::SURVEY_ID, $surveyId);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getFirstName()
    {
        return $this->getData(self::FIRST_NAME);
    }

    /**
     * Set Title.
     */
    public function setFirstName($firstName)
    {
        return $this->setData(self::FIRST_NAME, $firstName);
    }

    /**
     * Get getContent.
     *
     * @return varchar
     */
    public function getLastName()
    {
        return $this->getData(self::LAST_NAME);
    }

    /**
     * Set Content.
     */
    public function setLastName($lastName)
    {
        return $this->setData(self::LAST_NAME, $lastName);
    }

    /**
     * Get UpdateTime.
     *
     * @return varchar
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set UpdateTime.
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set CreatedAt.
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }
}
