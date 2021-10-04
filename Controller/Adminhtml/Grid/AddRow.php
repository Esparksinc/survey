<?php

namespace Esparksinc\Survey\Controller\Adminhtml\Grid;
 
use Magento\Framework\Controller\ResultFactory;
 
class AddRow extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;
 
    /**
     * @var \Esparksinc\Survey\Model\GridFactory
     */
    private $gridFactory;
 
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Esparksinc\Survey\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Esparksinc\Survey\Model\GridFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->gridFactory = $gridFactory;
    }
 
    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->gridFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getFirstName();
            if (!$rowData->getSurveyId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('grid/grid/rowdata');
                return;
            }
        }
 
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? $rowTitle : __('Add Survey Data');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
 
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Esparksinc_Survey::add_row');
    }
}
