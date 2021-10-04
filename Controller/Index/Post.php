<?php
namespace Esparksinc\Survey\Controller\Index;

class Post extends \Magento\Framework\App\Action\Action
{
    /**
* Recipient email config path
*/
const XML_PATH_EMAIL_RECIPIENT = 'survey/email/recipient_email';
const XML_PATH_ENABLED = 'survey/survey_email/enabled';
/**
 * @var \Magento\Framework\Mail\Template\TransportBuilder
 */
protected $_transportBuilder;

/**
 * @var \Magento\Framework\Translate\Inline\StateInterface
 */
protected $inlineTranslation;

/**
 * @var \Magento\Framework\App\Config\ScopeConfigInterface
 */
protected $scopeConfig;

/**
 * @var \Magento\Store\Model\StoreManagerInterface
 */
protected $storeManager;
/**
 * @var \Magento\Framework\Escaper
 */
protected $_escaper;
/**
 * @param \Magento\Framework\App\Action\Context $context
 * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
 * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
 * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
 * @param \Magento\Store\Model\StoreManagerInterface $storeManager
 */
public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
    \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    \Magento\Framework\Escaper $escaper
) {
    parent::__construct($context);
    $this->_transportBuilder = $transportBuilder;
    $this->inlineTranslation = $inlineTranslation;
    $this->scopeConfig = $scopeConfig;
    $this->storeManager = $storeManager;
    $this->_escaper = $escaper;
}

public function execute()
{
    $data = $this->getRequest()->getPostValue();
    $first = $data['firstName'];
    $last = $data['lastName'];
    $content = $data['content'];
    $email = $data['email'];
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $question = $objectManager->create('Esparksinc\Survey\Model\Grid');
    $question->setData($data);
    $question->setFirstName($first);
    $question->setLastName($last);
    $question->setContent($content);
    $question->setEmail($email);
    

    // Email Sending Code Start
    $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
    if($this->scopeConfig->getValue(self::XML_PATH_ENABLED, $storeScope)){
        $this->inlineTranslation->suspend();
        try {
            $postObject = new \Magento\Framework\DataObject();
            $postObject->setData($data);

            $error = false;

            $sender = [
                'name' => $this->_escaper->escapeHtml($data['firstName']),
                'email' => $this->_escaper->escapeHtml($data['email']),
            ];

            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport = $this->_transportBuilder
            ->setTemplateIdentifier('survey_email_email_template') // this code we have mentioned in the email_templates.xml
            ->setTemplateOptions(
                [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // this is using frontend area to get the template file
                'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
            ]
        )
            ->setTemplateVars(['data' => $postObject])
            ->setFrom($sender)
            ->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
            ->setReplyTo($data['email'])
            ->getTransport();

            $transport->sendMessage();
            ;
            $this->inlineTranslation->resume();
            $this->messageManager->addSuccess(__('Thanks for your valuable feedback. We\'ll contact you soon'));
            $question->save();
            $this->_redirect('*/*/');
            return;
            
        } catch (\Exception $e) {
            $this->inlineTranslation->resume();
            $this->messageManager->addError(
                __('We can\'t process your request right now. Sorry, that\'s all we know.'.$e->getMessage())
            );
            $this->_redirect('*/*/');
            return;
        }
    }
    else{
        $this->messageManager->addSuccess('Thanks for your valuable feedback.');
        $question->save();
        $this->_redirect('*/*/');
        return;
    }

    
    // Email Sending Code End
}
}
