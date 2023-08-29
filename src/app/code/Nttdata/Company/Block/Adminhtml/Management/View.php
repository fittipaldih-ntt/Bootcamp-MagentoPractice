<?php

namespace Nttdata\Company\Block\Adminhtml\Management;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;

class View extends Container
{
    protected $employeeId;
    protected $_blockGroup = 'Nttdata_Company';

    public function __construct(
        
        Context $context,
        array $data = []
    ) {
        $this->_controller = 'adminhtml_management';
        parent::__construct($context, $data);
    }
    
    protected function _construct()
    {
        parent::_construct();
        $this->_objectId = 'id';
        $this->setId('company_view_content');
        $this->removeButton('reset');
        $this->removeButton('save');
    }
    
    protected function _prepareLayout()
    {
        $this->employeeId = $this->getRequest()->getParam('id');
        
        $this->addButton(
            'edit',
            [
                'label'     => __('Edit'),
                'class'     => 'primary',
                'onclick'   => sprintf("location.href = '%s';", $this->getEditUrl()),
            ]
        );

        $message = __('Are you sure you want to delete this employee?');
        $this->addButton(
            'delete',
            [
                'label'     => __('Delete'),
                'class'     => 'primary',
                'onclick'   => "confirmSetLocation('{$message}', '{$this->getDeleteUrl('accept')}')"
            ]
        );

        return parent::_prepareLayout();
    }

    public function getEditUrl()
    {        
        return $this->getUrl('company/management/editemployee', ['id' => $this->employeeId]);
    }

    public function getDeleteUrl()
    {        
        return $this->getUrl('company/management/deleteemployee', ['id' => $this->employeeId]);
    }
}
