<?php


namespace Esparksinc\Survey\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'survey_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Esparksinc\Survey\Model\Grid',
            'Esparksinc\Survey\Model\ResourceModel\Grid'
        );
    }
}
