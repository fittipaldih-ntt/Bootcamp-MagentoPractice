<?php

namespace Nttdata\Company\Block\Adminhtml\Management\View;

use \Magento\Backend\Block\Template\Context;
use \Magento\Framework\Json\EncoderInterface;
use \Magento\Backend\Model\Auth\Session;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected $_coreRegistry;

    public function __construct(
        Context $context,
        EncoderInterface $jsonEncoder,
        Session $authSession,
        array $data = []
    ) {
        parent::__construct($context, $jsonEncoder, $authSession, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('company_management_view_tabs');
        $this->setDestElementId('form');
        $this->setTitle(__('Employee Details'));
    }

    protected function _prepareLayout()
    {
        $this->addTab(
            'info',
            [
                'label'     => __('Details'),
                'title'     => __('Employee Information'),
                'content'   => $this->getLayout()->createBlock('Nttdata\Company\Block\Adminhtml\Management\View\Tab\Info')->setTemplate('Nttdata_Company::company_management_viewemployee.phtml')->toHtml(),
                'active'    => true
            ]
        );

        $this->addTab(
            'other',
            [
                'label'     => __('Other'),
                'content'   => 'Probando que cambia de tab correctamente',
            ]
        );
        return parent::_prepareLayout();
    }
}
