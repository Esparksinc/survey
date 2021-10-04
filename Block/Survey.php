<?php
namespace Esparksinc\Survey\Block;

class Survey extends \Magento\Framework\View\Element\Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    public function getFormAction()
    {
            // companymodule is given in routes.xml
            // controller_name is folder name inside controller folder
            // action is php file name inside above controller_name folder

        // return 'magento2/survey/index/post';
        return $this->getUrl('survey/index/post');
        // here controller_name is index, action is post
    }
}
