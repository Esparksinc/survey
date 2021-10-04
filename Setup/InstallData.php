<?php

namespace Esparksinc\Survey\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
  protected $_postFactory;

  public function __construct(\Esparksinc\Survey\Model\GridFactory $postFactory)
  {
    $this->_postFactory = $postFactory;
  }

  public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
  {
    $data = [
      'first_name' => "Esparksinc",
      'last_name' => "Survey",
      'email' => 'hello@esparksinc.com',
      'content' => 'Welcome to Esparksinc'
    ];
    $post = $this->_postFactory->create();
    $post->addData($data)->save();
  }
}